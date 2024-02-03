<?php

namespace App\Http\Controllers\api_frontend;

use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $data = Delivery::orderBy('zone', 'ASC')->get();

        return response()->json([
            // 'status' => true,
            'message' => "Data Found",
            "data" => $data,
            "description" => 'Liste des zone de livraison',

        ], 200);
     }


    /**
     * @OA\Get(
     *     path="/api/v1/order",
     *     summary="Enregistrement de la commande du client",
     *     tags={"Commande "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

     public function  order(Request $request){
         try {

            //ger infos delivery
            $delivery = Delivery::whereId($request['livraison_id'])->first();

            $data = Order::firstOrCreate([
                "user_id" => Auth::user()->id,
                'quantity_product' => $request['qte_des_articles'],
                'subtotal' => $request['sous_total'],
                'total' => $delivery['tarif']  + $request['sous_total'],
                'delivery_price' => $delivery['tarif'],
                'delivery_name' =>   $delivery['zone'],
                // 'discount' => '',
                'delivery_planned' => Carbon::now()->addDay(3), //date de livraison prevue
                // 'delivery_date' => '', //date de livraison
                'status' => 'attente',         // livré, en attente
                // 'available_product' =>  '' //disponibilite
                'payment method' => 'paiement à la livraison',
                'date_order' => Carbon::now()->format('Y-m-d')

            ]);
             
             return $this->showAllOrderByUser();
         } catch (Exception $e) {
             return response()->json(['error'=>'Une erreur est survenue']);
         }
         
     }
     
  
     private function showAllOrderByUser(){
        //recuperation des commandes d'un utilisateur connecté
    //     $orders=[];
    //     $userId=Auth::user()->id;
    //     $userOrders=Order::where('user_id',$userId)->get();
    //     foreach ($userOrders as $userOrder) {
    //         $product=Product::find($userOrder->product_id);
    //         $orderDetail=[
    //             "product"=>$product,
    //             "quantity"=>$userOrder->quantity,
    //             "price"=>$product->price,
    //             "total"=>$product->price*$userOrder->quantity
    //         ];
    //         array_push($orders,$orderDetail);
    //     }
    //     $data=[
    //        'user_name'=>Auth::user()->name,
    //        'commands'=>$orders
    //    ];
    //     return response()->json(["data"=>$data]);
    }




}
