<?php

namespace App\Http\Controllers\api_frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketPlaceController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/v1/boutiqueAll",
     *     summary="Liste boutique",
     *     tags={" Liste des boutique "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    public function allStore()
    {
        $store = User::with([
            'roles', 'products'=>fn ($q) => $q->with(['media', 'categories', 'subcategorie']), 'media'
        ])
            ->whereHas('roles', fn ($q) => $q->where('name', 'boutique'))
            ->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'message' => "Data Found",
            "data" => $store,
            "description" => 'Liste des boutique de la marketplace',
        ], 200);
    }
}
