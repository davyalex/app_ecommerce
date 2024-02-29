<?php

namespace App\Http\Controllers\admin;

use App\Models\Taille;
use App\Models\Product;
use App\Models\Category;
use App\Models\Pointure;
use App\Models\Collection;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get role user
        $auth = Auth::check();
        $auth_role = Auth::user()->roles[0]->name;

        // dd($auth);

        //filtre par type de produit
        $type = request('type');
        if (Auth::check()  && $auth_role == 'boutique') {
            //recuperation des produits en fonction du filtre
            $product = Product::with(['categories', 'subcategorie', 'media', 'user'])
                ->where('user_id', Auth::user()->id)
                ->whereHas('user', fn ($q) => $q->where('role', 'boutique'))

                ->when($type, fn ($q) => $q->whereType($type))
                ->orderBy('created_at', 'DESC')
                ->get();
        } elseif (Auth::check()  && in_array($auth_role, ['developpeur', 'administrateur'])) {
            //recuperation des produits en fonction du filtre
            $product = Product::with(['categories', 'subcategorie', 'media', 'user'])
                ->whereHas('user', fn ($q) => $q->whereNotIn('role', ['boutique', 'client']))
                ->when($type, fn ($q) => $q->whereType($type))
                ->orderBy('created_at', 'DESC')
                ->get();
        }else{
            return abort('404');
        }


        // dd($product->toArray());
        return view('admin.pages.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $category = Category::orderBy('name', 'ASC')
        // ->whereType('principale')
        // ->get();
        $collection = Collection::orderBy('name', 'DESC')->get();


        return view('admin.pages.product.add', compact('collection'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->toArray());
        $data = $request->validate([
            'title' => ['required'],
            'description' => '',
            'price' => ['required'],
            'categories' => '',
            'type' => ['required'],
            'delivery_interieur' => ['required'],
            'delivery_abidjan' => ['required'],



        ]);


        $product = Product::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'price' => $request['price'],
            'type' => $request['type'],
            'disponibilite' => 'disponible', //disponible or rupture
            'sub_category_id' => $request['subcategories'],
            'user_id' => Auth::user()->id,
            'delivery_interieur' => $request['delivery_interieur'],
            'delivery_abidjan' => $request['delivery_abidjan']

        ]);

        //insert category principale in pivot table
        if ($request->has('categories')) {
            $product->categories()->attach($request['categories']);

            // DB::table('category_product')->insert([
            //     'category_id' => $request['categories'],
            //     'product_id' => $product->id
            // ]);

        }

        //insert category pack in pivot table
        if ($request->has('category_pack')) {
            $product->categories()->attach($request['category_pack']);

            // DB::table('category_product')->insert([
            //     'category_id' => $request['categories'],
            //     'product_id' => $product->id
            // ]);

        }


        //insert category section in pivot table
        if ($request->has('category_section')) {

            // DB::table('category_product')->insert([
            //     'category_id' => $request['category_section'],
            //     'product_id' => $product->id
            // ]);
            $product->categories()->attach($request['category_section']);
        }

        //insert taille in table
        // if ($request->has('tailles')) {
        //     foreach ($request->input('tailles') as $key => $value) {
        //         Taille::create(['taille' => $value, 'product_id' => $product->id]);
        //     }
        // }

        //insert pointure in table
        // if ($request->has('pointures')) {
        //     foreach ($request->input('pointures') as $key => $value) {
        //         Pointure::create(['pointure' => $value, 'product_id' => $product->id]);
        //     }
        // }

        //upload images with spatie
        if ($request->has('files')) {
            foreach ($request->file('files') as $value) {
                $product->addMedia($value)
                    ->toMediaCollection('product_image');
            }
        }

        return back()->withSuccess('nouveau produit ajouté avec success');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // $collection = Collection::orderBy('name', 'DESC')->get();

        $product = Product::with([
            'categories', 'subcategorie', 'collection', 'tailles', 'pointures', 'media'
        ])
            ->whereId($id)
            ->first();

        // dd($product->toArray());

        //sub cat of category selected

        $catId = $product['categories'][0]['id'];
        $subcategory_exist = SubCategory::where('category_id', $catId)
            ->orderBy('name', 'ASC')
            ->get();

        //get Image from database
        $images = [];

        foreach ($product->media as $value) {
            array_push($images, $value);
        }

        return view('admin.pages.product.edit', compact(
            'product',
            'subcategory_exist',
            // 'collection',
            'images'
        ));
    }


    /**
     * delete image on edit product.
     */
    public function deleteImage($id)
    {
        //
        $delete = DB::table('media')->whereId($id)->delete();

        return response()->json("suppression réussi");
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // dd($request->toArray());
        $data = $request->validate([
            'title' => ['required'],
            'description' => '',
            'price' => ['required'],
            'categories' => '',
            'type' => ['required'],
            'delivery_interieur' => ['required'],
            'delivery_abidjan' => ['required'],
        ]);

        $product = tap(Product::find($id))->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'price' => $request['price'],
            'type' => $request['type'],
            'disponibilite' => 'disponible', //disponible or rupture
            'collection_id' => $request['collection'],
            'sub_category_id' => $request['subcategories'],
            'delivery_interieur' => $request['delivery_interieur'],
            'delivery_abidjan' => $request['delivery_abidjan']

        ]);


        //insert category in pivot table
        if ($request->has('categories')) {
            $product->categories()->detach();
            // $product->categories()->detach($request['categories']);
            $product->categories()->attach($request['categories']);
        }

        if ($request->has('category_pack')) {
            $product->categories()->detach();
            $product->categories()->attach($request['category_pack']);
        }

        if ($request->has('category_section')) {
            $product->categories()->detach();
            $product->categories()->attach($request['category_section']);
        }

        //upload images with spatie
        if ($request->has('files')) {
            foreach ($request->file('files') as $value) {
                $product->addMedia($value)
                    ->toMediaCollection('product_image');
            }
        }

        //insert taille in table
        // if ($request->has('tailles')) {
        //     Taille::where('product_id', $id)->delete();

        //     foreach ($request->input('tailles') as $key => $value) {
        //         Taille::create(['taille' => $value, 'product_id' => $product->id]);
        //     }
        // } else {
        //     Taille::where('product_id', $id)->delete();
        // }

        //insert pointure in table
        // if ($request->has('pointures')) {
        //     Pointure::where('product_id', $id)->delete();

        //     foreach ($request->input('pointures') as $key => $value) {
        //         Pointure::create(['pointure' => $value, 'product_id' => $product->id]);
        //     }
        // } else {
        //     Pointure::where('product_id', $id)->delete();
        // }

        return redirect()->route('product.index')->withSuccess('Produit modifié avec success ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Product::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }






    /*********OTHER FUNCTION */

    public function loadSubcat($id)
    {
        //
        $data = SubCategory::where('category_id', $id)->get();

        return response()->json($data);
    }
}
