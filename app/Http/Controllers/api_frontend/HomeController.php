<?php

namespace App\Http\Controllers\api_frontend;

use Exception;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *    title="My Cool API",
 *    description="An API of cool stuffs",
 *    version="1.0.0",
 * )
 */
class HomeController extends Controller
{
    //Get Principal Category list with subCategory and media 
    /**
     * @OA\Get(
     *     path="v1/principalCategory",
     *     summary="Get a list of category list",
     * @OA\Info() ,
     *     tags={"principalCategory"},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     */
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
