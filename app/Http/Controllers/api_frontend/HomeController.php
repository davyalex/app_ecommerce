<?php

namespace App\Http\Controllers\api_frontend;

use Exception;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    //Get Principal Category list with subCategory and media 
    /**
     * @OA\Get(
     *     path="/api/v1/principalCategory",
     *     summary="Recuperer la liste des categories de type principal avec les produits et sous categories a l'interieur",
     *     tags={"Liste des categories de type principale"},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     */
    public function principalCategory()
    {
        try {
            $data = Category::with([
                'products' => function ($q) {
                    return $q->with('subcategorie','media')->inRandomOrder();
                }, 'media', 'subcategories' => fn ($q) => $q->with(['products','media'])
            ])
                ->orderBy('created_at', 'DESC')
                ->whereType('principale')
                ->get();


            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data,
                "description" => 'recuperation des categories principales',

            ], 200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }



    //Get Section Category with products
    /**
     * @OA\Get(
     *     path="/api/v1/sectionCategory",
     *     summary="Recuperer la liste des categories de type section avec les produits a l'interieur",
     *     tags={"Liste des categories de type section"},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     */
    public function sectionCategory()
    {
        try {
            $data = Category::with(['media', 'products' => fn ($q) => $q->with('media')])
                ->orderBy('created_at', 'DESC')
                ->whereType('section')
                ->get();

            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data,
                "description" => 'recuperation des categories de type section avec les produits',
            ], 200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }


    //Get Pack Category with products
    /**
     * @OA\Get(
     *     path="/api/v1/categoryPack",
     *     summary="Recuperer la liste des categories de type pack avec les produits a l'interieur",
     *     tags={"Liste des categories de type pack"},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     */
    public function CategoryPack()
    {
        try {
            $data = Category::with([
                'media', 'products' => fn ($q) =>
                $q->with(['subcategorie', 'media']),
            ])
                ->orderBy('created_at', 'DESC')
                ->whereType('pack')
                ->get();

            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data,
                "description" => 'recuperation de la categories dpack avec les produits',
            ], 200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }


    /**
     * @OA\Get(
     *     path="/api/v1/someProduct",
     *     summary="Liste de quelque produits de toutes categories confondue",
     *     tags={"Liste de quelques produits  de toutes les categories"},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     */

    public function someProduct()
    {
        $data = Product::with(['categories', 'subcategorie', 'media'])->inRandomOrder()->take(30)->get();

        return response()->json([
            // 'status' => true,
            'message' => "Data Found",
            "data" => $data,
            "description" => 'recuperation de quelques quelque produits de toutes categories confondue',

        ], 200);
    }

    

    /*******Get Sliders */
    public function slider()
    {
        try {
            $data = Slider::with('media')->orderBy('created_at', 'DESC')->get();

            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data,
                "description" => 'recuperation des sliders',

            ], 200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
