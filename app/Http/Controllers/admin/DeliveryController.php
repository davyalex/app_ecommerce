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
      
        $delivery = Delivery::with(['parent_region', 'child_zone'])
            ->when(request('deli')=='region', fn ($q) => $q->whereNotNull('region'))
            ->when(request('deli')== 'ville-commune', fn ($q) => $q->whereNull('region')) //ville-commune
            ->get();

        //Liste des regions dans la table livraison
        $regions = Delivery::orderBy('region', 'ASC')->whereNotNull('region')->get();
        // dd($delivery->toArray());
        return view('admin.pages.delivery.index', compact('delivery', 'regions'));
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
            'zone' => '',
            'tarif' => '',
            'region' => '',
            'region_id' => '',
            'parent_id' => '',

        ]);



        $delivery = delivery::firstOrCreate($data);

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
            'zone' => '',
            'tarif' => '',
            'region' => '',
            'parent_id' => '',


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
            'status' => 200
        ]);
    }
}
