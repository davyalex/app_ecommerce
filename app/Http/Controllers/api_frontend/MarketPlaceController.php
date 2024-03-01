<?php

namespace App\Http\Controllers\api_frontend;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketPlaceController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/v1/marketplace/allStore",
     *     summary="Liste boutique",
     *     tags={" Liste des boutique "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    public function allStore()
    {
        $store = User::with([
            'roles', 'products' => fn ($q) => $q->with(['media', 'categories', 'subcategorie']),
            'media'
        ])->withCount('products')

            ->whereHas('roles', fn ($q) => $q->where('name', 'boutique'))
            ->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'message' => "Data Found",
            "data" => $store,
            "description" => 'Liste des boutique de la marketplace',
        ], 200);
    }




    /**
     * @OA\Get(
     *     path="/api/v1/marketplace/productAllStore",
     *     summary="Liste de tous les produits de toute les boutiques",
     *     tags={" Liste de tous les produits de toute les boutiques "},
     *     
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     **/

    public function productAllStore()
    {

        $data = Product::with([
            'user'=>fn($q) => $q->with('media'), 'subcategorie', 'media', 'categories'
        ])
            ->whereHas('user', fn ($q) => $q->where('role', 'boutique'))
            ->inRandomOrder()->paginate(36);

        return response()->json([
            'message' => "Data Found",
            "data" => $data,
            "description" => 'Liste des produits de toutes les boutiques de la marketplace',
        ], 200);
    }




    /**
     * @OA\Get(
     *     path="/api/v1/marketplace/productStore",
     *     summary="Voir les produits d'une boutique",
     *     tags={" Liste des produits d'une boutique "},
     *     
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    public function  productStore(Request $request)
    {
        $data = Product::with([
            'media', 'categories', 'user' => fn ($q) => $q->with('media')

        ])
            ->where('user_id', $request['id'])
            ->inRandomOrder()->paginate(15);

        return response()->json([
            "data" => $data,
            "requestId" => $request['id'],
            "description" => 'Liste des produits d\'une boutique de la marketplace',
        ], 200);
    }


    /**
     * @OA\Get(
     *     path="/api/v1/marketplace/productDetail",
     *     summary="Voir les details du produits d'une boutique",
     *     tags={" Detail du produits d'une boutique "},
     *     
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */


    public function productDetail(Request $request)
    {

        try {
            $data = Product::with([
                'user' => fn ($q) => $q->with('media'), 'media', 'categories', 'subcategorie'
            ])
                ->whereId($request['id'])->first();

            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data,
                "description" => 'Detail d\'un produit',

            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                // 'status' => true,
                'message' => "Data not Found",
            ], 200);
        }
    }
}
