<?php

namespace App\Http\Controllers\api_frontend;

use Exception;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Publicite;
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
                    return $q->with(
                        [
                            'subcategorie' =>
                            fn ($q) => $q->orderBy('created_at', 'ASC'),
                            'user', 'media'
                        ]
                    )
                        ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique'))
                        ->inRandomOrder()->paginate(15);
                }, 'media', 'subcategories' => fn ($q) => $q->with(['products', 'media'])
            ])
                ->orderBy('created_at', 'ASC')
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
            $data = Category::with([
                'media', 'products' => fn ($q) => $q
                    ->with(['media', 'user'])
                    ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique'))
            ])
                ->orderBy('created_at', 'ASC')
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
                $q->with(['subcategorie', 'media', 'user'])
                    ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique')),
            ])
                ->orderBy('created_at', 'DESC')
                ->whereType('pack')
                ->get();

            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data,
                "description" => 'recuperation de la categories pack avec les produits',
            ], 200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }



    /**
     * @OA\Get(
     *     path="/api/v1/productPack",
     *     summary="Liste des produits packs",
     *     tags={"Liste des produits packs"},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     */

    public function productPack()
    {
        $data = Product::with([
            'categories', 'subcategorie', 'media', 'user'
        ])
            ->whereType('pack')
            ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique'))
            ->inRandomOrder()->get();

        return response()->json([
            // 'status' => true,
            'message' => "Data Found",
            "data" => $data,
            "description" => 'Liste des produits packs',

        ], 200);
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
        $data = Product::with(['categories', 'subcategorie', 'media', 'user'])
            ->whereHas('user', fn ($q) => $q->where('role', '!=', 'boutique'))
            ->inRandomOrder()->take(30)->get();

        return response()->json([
            // 'status' => true,
            'message' => "Data Found",
            "data" => $data,
            "description" => 'recuperation de quelques quelque produits de toutes categories confondue',

        ], 200);
    }


    /**
     * @OA\Get(
     *     path="/api/v1/publicite",
     *     summary="Liste des publicite par type['slider', 'popup', 'top-header', 'background', 'small-card']",
     *     tags={"Liste des publicites par type"},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     */

    public function publicite()
    {
        try {
            //publicite type slide/carrousel
            $slider = Publicite::with('media')
                ->where('type', 'slider')
                ->orderBy('created_at', 'DESC')->get();

            //publicite type top-header
            $top_header = Publicite::with('media')
                ->where('type', 'top-header')
                ->orderBy('created_at', 'DESC')->get();

            //publicite type banniere
            $banniere = Publicite::with('media')
                ->where('type', 'banniere')
                ->orderBy('created_at', 'DESC')->get();

            //publicite type small-card
            $small_card = Publicite::with('media')
                ->where('type', 'small-card')
                ->orderBy('created_at', 'DESC')->get();

            //publicite type background arriere plan
            $background = Publicite::with('media')
                ->where('type', 'background')
                ->orderBy('created_at', 'DESC')->get();

            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "slider" => $slider,
                "top_header" => $top_header,
                "banniere" => $banniere,
                "small_card" => $small_card,
                "background" => $background,
                "description" => 'recuperation des publicités par type ',

            ], 200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
