<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material1;
use App\Models\Material2;
use App\Models\Material3;
use App\Models\Material4;
use App\Models\Category;
use App\Models\Furniture;
use App\Models\FurnitureImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderBy = 'name';
        $order = 'asc';

        switch (request('orderBy')) {
            case 'nameAsc':
                $orderBy = 'name';
                $order = 'asc';
                break;
            case 'nameDesc':
                $orderBy = 'name';
                $order = 'desc';
                break;
            case 'newest':
                $orderBy = 'created_at';
                $order = 'desc';
                break;
            case 'oldest':
                $orderBy = 'created_at';
                $order = 'asc';
                break;
            default:
                $orderBy = 'name';
                $order = 'asc';
                break;
        }

        $show = request('show') ?? '5';
        $with = ['category', 'material1', 'material2', 'material3', 'material4', 'furniture_images'];
        $furnitures = Furniture::filter(request(['category', 'material1', 'material2', 'material3', 'material4', 'search']))->with($with)->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('furnitures.index', [
            'page' => 'furnitures',
            'furnitures' => $furnitures,
            'allFurnitures' => Furniture::all(),
            'categories' => Category::all(),
            'material1s' => Material1::all(),
            'material2s' => Material2::all(),
            'material3s' => Material3::all(),
            'material4s' => Material4::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('furnitures.create', [
            'page' => 'furnitures',
            'categories' => Category::all(),
            'material1s' => Material1::all(),
            'material2s' => Material2::all(),
            'material3s' => Material3::all(),
            'material4s' => Material4::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        /**
         * create fields
         */
        $fields = [
            'category_id' => $req['category_id'],
            'material1_id' => $req['material1_id'],
            'material2_id' => $req['material2_id'],
            'material3_id' => $req['material3_id'],
            'material4_id' => $req['material4_id'],
            'sku' => $req['sku'] ?? 00000000,
            'name' => $req['name'],
            'image' => $req['image'],
            'length' => $req['length'] ?? 0,
            'width' => $req['width'] ?? 0,
            'height' => $req['height'] ?? 0,
            'size' => $req['size'] ?? '-',
            'price' => $req['price'] ?? 0,
            'stock' => $req['stock'] ?? 0,
        ];

        /**
         * create rules validator
         */
        $rules = [
            'category_id' => 'required|numeric',
            'material1_id' => 'required',
            'material2_id' => 'required',
            'material3_id' => 'required',
            'material4_id' => 'required',
            'sku' => 'required|unique:furniture,sku|numeric',
            'name' => 'required|min:3|unique:furniture,name',
            'image' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'size' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        /**
         * run validator
         */
        $validator = Validator::make($fields, $rules);

        /**
         * run validator
         */
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /**
         * create validator image
         */
        foreach ($fields['image'] as $data) {
            $validatorImage = Validator::make(['image' => $data], ['image' => 'required|image|max:2024']);

            /**
             * run validator image
             */
            if ($validatorImage->fails()) {
                return redirect()->back()->withErrors($validatorImage)->withInput();
            }
        }

        /**
         * generate size
         */
        $fields['size'] = $fields['length'] . 'cm x ' . $fields['width'] . 'cm x ' . $fields['height'] . 'cm';

        /**
         * generate code
         */
        $sku1 = Material1::find($fields['material1_id'])['sku'];
        $sku2 = Material2::find($fields['material2_id'])['sku'];
        $sku3 = Material3::find($fields['material3_id'])['sku'];
        $sku4 = Material4::find($fields['material4_id'])['sku'];
        $sku15 = $fields['category_id'] . $sku1 . $sku2 . $sku3 . $sku4;

        $furniture_sku = Furniture::where('sku', 'like', '%' . $sku15 . '%')->orderBy('sku', 'desc')->first();
        if (!$furniture_sku) {
            $id = str_pad(1, 3, '0', STR_PAD_LEFT);
            $fields['sku'] = $sku15 . $id;
        } else {
            $id = str_pad((substr($furniture_sku['sku'], -3) + 1), 3, '0', STR_PAD_LEFT);
            $fields['sku'] = $sku15 . $id;
        }

        Furniture::create($fields);
        $furniture_id = Furniture::latest()->first()->id;

        /**
         * manage image request
         */
        foreach ($fields['image'] as $data) {
            if (File::isFile($data)) {
                $image_name = $data->getInode() . time() . "." . $data->getClientOriginalExtension();
                $image_url = url('img/furnitures/' . $image_name);
                $data->move('img/furnitures', $image_name);

                FurnitureImage::create([
                    'furniture_id' => $furniture_id,
                    'name' => $image_name,
                    'url' => $image_url,
                ]);
            }
        }

        return redirect('/furnitures?orderBy=newest')->with('success', 'Furniture berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $with = ['category', 'material1', 'material2', 'material3', 'material4', 'furniture_images'];
        $furniture = Furniture::with($with)->find($id);

        if (!$furniture) {
            return back()->with('warning', 'furniture not found!');
        }

        return view('furnitures.show', [
            'page' => 'furnitures',
            'furniture' => $furniture,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $with = ['category', 'material1', 'material2', 'material3', 'material4', 'furniture_images'];
        $furniture = Furniture::with($with)->find($id);

        if (!$furniture) {
            return back()->with('warning', 'Furniture tidak ditemukan!');
        }

        return view('furnitures.edit', [
            'page' => 'furnitures',
            'furniture' => $furniture
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $furniture = Furniture::find($id);

        if (!$furniture) {
            return back()->with('warning', 'Furniture tidak ditemukan!');
        }

        /**
         * create fields
         */
        $fields = [
            'name' => $req['name'] ?? $furniture['name'],
            'length' => $req['length'] ?? $furniture['length'],
            'width' => $req['width'] ?? $furniture['width'],
            'height' => $req['height'] ?? $furniture['height'],
            'size' => $req['size'] ?? $furniture['size'],
            'price' => $req['price'] ?? $furniture['price'],
            'stock' => $req['stock'] ?? $furniture['stock'],
        ];

        /**
         * create rules validator
         */
        $rules = [
            'name' => 'required|min:3|unique:furniture,name',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'size' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        /**
         * update rules
         */
        if ($fields['name'] == $furniture->name) {
            $rules['name'] = 'required|min:3';
        }

        /**
         * run validator
         */
        $validator = Validator::make($fields, $rules);

        /**
         * run validator
         */
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /**
         * generate size
         */
        $fields['size'] = $fields['length'] . 'cm x ' . $fields['width'] . 'cm x ' . $fields['height'] . 'cm';

        $furniture->update($fields);

        $query = str_replace('/furnitures/' . $id, '', request()->getRequestUri());

        return redirect('/furnitures/' . $id . $query)->with('success', 'Furniture berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $furniture = Furniture::find($id);

        if (!$furniture) {
            return back()->with('warning', 'Furniture tidak ditemukan!');
        }

        /**
         * delete old image
         */
        $furniture_images = FurnitureImage::where('furniture_id', $id)->get();
        foreach ($furniture_images as $data) {
            if (File::exists('img/furnitures/' . $data->name)) {
                File::delete('img/furnitures/' . $data->name);
            }
        }

        $furniture->delete();

        $query = str_replace('/furnitures/' . $id, '', request()->getRequestUri());

        return redirect('/furnitures' . $query)->with('success', 'Furniture berhasil dihapus');
    }
}
