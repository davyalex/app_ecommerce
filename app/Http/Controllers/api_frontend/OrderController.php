<?php

namespace App\Http\Controllers\api_frontend;

use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function delivery()
    {
        $data = Delivery::with('child_zone')
         ->whereNotNull('region')
        ->orWhereNull('region_id')
        ->orderBy('zone', 'ASC')->get();

        return response()->json([
            // 'status' => true,
            'message' => "Data Found",
            "data" => $data,
            "description" => 'Liste des zone de livraison',

        ], 200);
    }


    /**
     * @OA\POST(
     *     path="/api/v1/order",
     *     summary="Enregistrement de la commande du client",
     *     tags={"Commande "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    public function  order(Request $request)
    {
        try {

            if (!auth('sanctum')->check()) {
                throw new Exception("Vous devez être connecté pour acceder aux commandes");
            } else {
                //get infos delivery
                $delivery = Delivery::whereId($request['livraison_id'])->first();

                //save order
                $data = Order::firstOrCreate([
                    "user_id" => Auth::user()->id,
                    'quantity_product' => $request['qte_des_articles'],
                    'subtotal' => $request['sous_total'],
                    'total' => $request['total_livraison']  + $request['sous_total'],
                    'delivery_price' => $delivery['tarif'],
                    'delivery_name' =>   $delivery['zone'],
                    'total_livraison' => $request['total_livraison'],
                    'mode_livraison' =>   $request['mode_livraison'], // Expedition(Interieur) ou  Abidjan
                    // 'discount' => '',
                    'delivery_planned' => Carbon::now()->addDay(3), //date de livraison prevue
                    // 'delivery_date' => '', //date de livraison
                    'status' => 'attente',         // livré, en attente
                    // 'available_product' =>  '' //disponibilite
                    'payment method' => 'paiement à la livraison',
                    'date_order' => Carbon::now()->format('Y-m-d')

                ]);


                //insert data in pivot order_product
                // foreach ($request['produits'] as $key => $value) {
                //     $data->products()->attach($key, [
                //         'quantity' => $value['qte_unitaire'],
                //         'unit_price' => $value['prix_unitaire'],
                //         'total' => $value['qte_unitaire'] * $value['prix_unitaire'],
                //     ]);
                // }

                foreach ($request['produits'] as $value) {
                    DB::table('order_product')->insert([
                        'order_id' => $data['id'],
                        'product_id' => $value['produit_id'],
                        'quantity' => $value['qte_unitaire'],
                        'unit_price' => $value['prix_unitaire'],
                        'total' => $value['qte_unitaire'] * $value['prix_unitaire'],
                    ]);
                }

                return response()->json(['success' => true, 'message' => 'La commande a été bien enregistrée']);
            }

            // return $this->showAllOrderByUser();
        } catch (Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue']);
        }
    }





    /**
     * @OA\GET(
     *     path="/api/v1/userOrderList",
     *     summary="La liste des commandes du client",
     *     tags={"Liste des Commandes du client "},
     *     @OA\Response(response=200, description="Successful operation"),
     * 
     * )
     * 
     */
    public function userOrder(Request $request)
    {
        try {
            if (!auth('sanctum')->check()) {
                throw new Exception("Vous devez être connecté pour acceder aux commandes");
            } else {
                $orders = Order::where('user_id', Auth::user()->id)
                    ->with(['products' => fn ($q) => $q->with('media')])->orderBy('created_at', 'DESC')->get();

                return response()->json([
                    // 'status' => true,
                    'message' => "Data Found",
                    "data" => $orders,
                    "description" => 'Liste des commandes du client',

                ], 200);
            }
        } catch (Exception $ex) {
            return  ['errors' => $ex->getMessage()];
        }
    }


    /**
     * @OA\GET(
     *     path="/api/v1/userOrder/{id}",
     *     summary="Detail d'une commandes",
     *     tags={"Detail d'une commande "},
     *     @OA\Response(response=200, description="Successful operation"),
     * 
     *  @OA\Parameter(
     *          name="id",
     *          description="Commande id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * )
     * 
     */

    public function userOrderDetail($id)
    {
        try {

            if (!auth('sanctum')->check()) {
                throw new Exception("Vous devez être connecté pour accèder à cette ressource");
            }

            $order = Order::whereId($id)
                ->with([
                    'user', 'products'
                    => fn ($q) => $q->with('media')
                ])
                ->orderBy('created_at', 'DESC')->first();

            if ($order == null) {
                throw new Exception("Cette commande n'existe pas");
            } elseif ($order->user_id != Auth::user()->id) {
                throw new Exception("Vous ne pouvez pas consulter cette commande");
            }



            return response()->json([
                'status' => true,
                'data' => $order,
                'message' => "Détail de la commande récupéré avec succès"
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
