<?php

namespace App\Http\Controllers\api_frontend;

use Exception;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //Get Principal Category list with subCategory and media 

    public function principalCategory()
    {
        try {
            $data = Category::with([
               'products'=> function($q){
                return $q->with('media');
               }
               ,'media', 'subcategories' => fn ($q) => $q->with('media')
            ])
                ->orderBy('created_at', 'DESC')
                ->whereType('principale')
                ->get()
                ->map(
                    function ($q) {
                        $q->products = $q->products->take(1); // take only 15 query
                        return $q;
                    }
                );


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
    public function CategoryPack()
    {
        try {
            $data = Category::with([
                'media' , 'products' => fn ($q) =>
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


    //Get 


    /*******Get Sliders */
    public function slider()
    {
        try {
            $data = Slider::with('media')->
            orderBy('created_at', 'DESC')->get();

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
