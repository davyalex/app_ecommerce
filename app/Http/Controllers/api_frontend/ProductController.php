<?php

namespace App\Http\Controllers\api_frontend;

use App\Models\Product;
use App\Models\Category;
use App\Models\Commentaire;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //

    /**
     * @OA\Get(
     *     path="/api/v1/allProduct",
     *     summary="Liste de tous les produits:
     *     Pour  recuperer un produit par sa categorie envoyez 
     *     l'id de la catégorie dans le paramètre en GET {category} 
     *     ou {subcategory} pour recuperer les produits d'une sous categorie 
     * Exemple: http://127.0.0.1:8000/api/v1/allProduct?category={id}",
     *     tags={"Liste de tous les produits "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    public function allProduct(Request $request)
    {

        try {
            $category_id = request('category');
            $subcategory_id = request('subcategory');

            // Get infos category if request category_id
            // $data_category = Category::with([
            //     'subcategories' => fn ($q) => $q->with(['media', 'products']), 'media'
            // ])->whereId($category_id)->first();

            $data_category = "";

            if ($category_id) {

                // Get infos category if request category_id
                $data_category = Category::with([
                    'subcategories' => fn ($q) => $q->with(['media', 'products']), 'media'
                ])->whereId($category_id)->first();


                $data_product = Product::whereHas(
                    'categories',
                    fn ($q) => $q->where('category_product.category_id', $category_id),

                )->with(['user', 'media', 'categories', 'subcategorie', 'user', 'commentaires'])
                    ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique'))
                    ->inRandomOrder()->paginate(36);
            } elseif ($subcategory_id) {

                // Get infos category if request subcategory_id
                $data_category = SubCategory::with([
                    'category' => fn ($q) => $q->with(['media', 'products']), 'media'
                ])->whereId($subcategory_id)->first();


                $data_product = Product::with(['subcategorie', 'user', 'media', 'categories', 'commentaires'])
                    ->where('sub_category_id', $subcategory_id)
                    ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique'))
                    ->inRandomOrder()->paginate(36);
            } else {
                $data_product = Product::with(['subcategorie', 'user', 'media', 'categories', 'commentaires'])
                    ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique'))
                    ->inRandomOrder()->paginate(36);
            }

            // $data_product = Product::with(['media', 'categories', 'subcategorie'])
            //     ->when($category_id, fn ($q) => $q->whereHas(
            //         'categories',
            //         fn ($q) => $q->where('category_product.category_id', $category_id),
            //     ))
            //     ->when($subcategory_id, fn ($q) => $q->where('sub_category_id', $subcategory_id))
            //     ->inRandomOrder()->paginate(30);

            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "products" => $data_product,
                "category" => $data_category,
                "description" => 'Liste des produits || parametre: category or subcategory',

            ], 200);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * @OA\Get(
     *     path="/api/v1/detailProduct",
     *     summary="detail d'un produit:
     *     Pour  recuperer les detail d'un produit, envpoyez l'id du produit en GET {product} 
     * Exemple: http://127.0.0.1:8000/api/v1/detailProduct?product={id}",
     *     tags={"Detail d'un produit "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    public function detailProduct(Request $request)
    {

        try {
            $product_id = request('product');
            $data = Product::with(['media', 'categories', 'subcategorie', 'commentaires'])
                ->whereId($product_id)->first();


            $product_related =
                Product::with(['media', 'user', 'categories', 'subcategorie', 'commentaires'])
                ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique'))
                ->whereHas('categories', fn ($q) => $q->where('category_product.category_id', $data['categories'][0]['id']))
                ->where('sub_category_id', $data['sub_category_id'])
                ->where('id', '!=',  $product_id)
                ->inRandomOrder()->take(30)->get();


            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data,
                "productRelated" => $product_related,
                "description" => 'Detail d\'un produit & produit en relation',

            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                // 'status' => true,
                'message' => "Data not Found",
            ], 200);
        }
    }


    /**
     * @OA\Get(
     *     path="/api/v1/product?q=?",
     *     summary="Rechercher un produit",
     *     tags={"Rechercher un produit "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    public function searchProduct(Request $request)
    {

        try {
            $search = request('q');
            $data = Product::with(['categories', 'user', 'subcategorie', 'media'])
                ->where('title', 'Like', "%{$search}%")
                ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique'))
                ->orderBy('created_at', 'desc')->paginate(36);

            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data,
                "description" => 'Rechercher un produit',

            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Data not Found",
            ], 200);
        }
    }



    /**
     * @OA\Get(
     *     path="/api/v1/productComment",
     *     summary="Commenter un produit",
     *     tags={"Commenter un produit "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    //creer un commentaire lié a un produits
    public function comments(Request $request)
    {
        if (Auth::check()) {
            $commentaire = Commentaire::create([
                'note' => $request['note'],
                'description' => $request['description'],
                'product_id' => $request['productId'],
                'user_id' => $request['userId'],
            ]);

            $data = Commentaire::with(['user', 'product'])
                ->whereId($commentaire['id'])->first();

            return response()->json([
                'status'  => 200,
                'data'  => $data
            ], 200);
        } else {
            return response()->json([
                'status'  => 200,
                'message'  => 'vous devez etre connecté'
            ], 200);
        }
    }
}
