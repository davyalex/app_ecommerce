<?php

namespace App\Http\Controllers\admin;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $delivery = Delivery::orderBy('zone','ASC')->get();

        return view('admin.pages.delivery.index',compact('delivery'));
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
            'zone' => 'required',
            'tarif' => 'required',
        ]);

      

        $delivery = delivery::firstOrCreate([
            'zone' => $request['zone'],
            'tarif' => $request['tarif'],
        ]);

        return back()->with('success', 'Nouvelle delivery ajoutée avec success');
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
        $delivery = Delivery::whereId($id)->first();

        return view('admin.pages.delivery.edit', compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data =  $request->validate([
            'zone' => 'required',
            'tarif' => 'required',
        ]);

      
        delivery::whereId($id)->update([
            'zone' => $request['zone'],
            'tarif' => $request['tarif'],

        ]);

        return back()->withSuccess('delivery modifiée avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Delivery::whereId($id)->delete();
        return response()->json([
            'status'=>200
        ]);
    }
}
