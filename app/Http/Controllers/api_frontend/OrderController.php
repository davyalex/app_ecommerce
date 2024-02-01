<?php

namespace App\Http\Controllers\api_frontend;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/v1/delivery",
     *     summary="Liste des zone de livraison",
     *     tags={" Liste des zones de livraison "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

     public function delivery(){
        $data = Delivery::get();
        return response()->json([
            // 'status' => true,
            'message' => "Data Found",
            "data" => $data,
            "description" => 'Liste des zone de livraison',

        ], 200);
     }



}
