<?php

namespace App\Http\Controllers\admin;

use App\Models\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $collection = Collection::orderBy('name', 'ASC')->get();

        return view('admin.pages.collection.index', compact('collection'));
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
        $data =  $request->validate([
            'name' => 'required',
        ]);


        $Collection = Collection::firstOrCreate([
            'id' => Str::random(9),
            'name' => $request['name'],
        ]);

             //upload category_image
             if ($request->has('collection_img')) {
                $Collection->addMediaFromRequest('collection_img')->toMediaCollection('collection_image');
            }
    

        return back()->with('success', 'Nouvelle Collection ajoutée avec success');
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
        $collection = Collection::whereId($id)->first();

        return view('admin.pages.collection.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data =  $request->validate([
            'name' => 'required',
        ]);


        $collection = tap(Collection::find($id))->update([
            'name' => $request['name'],
        ]);

        //upload category_image 
        if ($request->has('collection_img')) {
            $collection->clearMediaCollection('collection_image');
            $collection->addMediaFromRequest('collection_img')->toMediaCollection('collection_image');
            }
            
        return back()->withSuccess('Collection modifiée avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Collection::whereId($id)->delete();
        return response()->json([
            'status'=>200
        ]);
    }
}
