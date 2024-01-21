<?php

namespace App\Http\Controllers\api_frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class HomeController extends Controller
{
    //Get Principal Category list with subCategory and media 
    public function principalCategory()
    {
        try {
            $data = Category::with([
                'media', 'subcategories' => fn ($q) => $q->with('media')
            ])
                ->orderBy('created_at', 'DESC')
                ->whereType('principale')
                ->get();


            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data
            ], 200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    //Get Section Category with product
    public function sectionCategory()
    {
        try {
            $data = Category::with(['media','products'])
                ->orderBy('created_at', 'DESC')
                ->whereType('section')
                ->get();

            return response()->json([
                // 'status' => true,
                'message' => "Data Found",
                "data" => $data
            ], 200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
