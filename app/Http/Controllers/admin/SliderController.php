<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $slider = Slider::orderBy('created_at', 'DESC')->get();

        return view('admin.pages.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->toArray());
        $data =  $request->validate([
            'type' => 'required',
        ]);


        $slider = Slider::create([
            'type' => $request['type'],
            'url' => $request['url'],

        ]);

             //upload category_image
             if ($request->has('image')) {
                $slider->addMediaFromRequest('image')->toMediaCollection('slider_image');
            }
    

        return back()->with('success', 'Nouvelle slider ajoutée avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $slider = Slider::whereId($id)->first();

        return view('admin.pages.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         //
         $data =  $request->validate([
            'type' => 'required',
        ]);


        $slider = tap(Slider::find($id))->update([
            'type' => $request['type'],
            'url' => $request['url'],
        ]);

        //upload category_image 
        if ($request->has('image')) {
            $slider->clearMediaCollection('slider_image');
            $slider->addMediaFromRequest('image')->toMediaCollection('slider_image');
            }
            
        return back()->withSuccess('slider modifiée avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Slider::whereId($id)->delete();
        return response()->json([
            'status'=>200
        ]);
    }
}
