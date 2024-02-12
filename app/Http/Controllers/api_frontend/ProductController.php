<?php

namespace App\Http\Controllers\api_frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;

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
            $data_category = Category::with([
                'subcategories' => fn ($q) => $q->with(['media', 'products']), 'media'
            ])->whereId($category_id)->first();
                


            if ($category_id) {

                // Get infos category if request category_id
                $data_category = Category::with([
                    'subcategories' => fn ($q) => $q->with(['media', 'products']), 'media'
                ])->whereId($category_id)->first();
                


                $data_product = Product::whereHas(
                    'categories',
                    fn ($q) => $q->where('category_product.category_id', $category_id),

                )->with(['collection', 'media', 'categories', 'subcategorie'])
                    ->inRandomOrder()->paginate(36);
            } elseif ($subcategory_id) {

                // // Get infos category if request category_id
                // $data_category = SubCategory::with([
                //     'categorie' => fn ($q) => $q->with(['media', 'products']), 'media'
                // ])->whereId($subcategory_id)->first();
                

                $data_product = Product::with(['collection', 'media', 'categories','subcategorie'])
                    ->where('sub_category_id', $subcategory_id)->inRandomOrder()->paginate(36);
            } else {
                $data_product = Product::with(['collection', 'media', 'categories', 'subcategorie'])
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
                "subcategory" => $subcategory_id,


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
            $data = Product::with(['media', 'categories', 'subcategorie'])
                ->whereId($product_id)->first();


            $product_related =
                Product::with(['media', 'categories', 'subcategorie'])
                ->whereHas('categories', fn ($q) => $q->where('category_product.category_id', $data['categories'][0]['id']))
                ->orWhere('sub_category_id', $data['sub_category_id'])
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
            $data = Product::with(['categories', 'subcategorie', 'media'])
                ->where('title', 'Like', "%{$search}%")
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
}
