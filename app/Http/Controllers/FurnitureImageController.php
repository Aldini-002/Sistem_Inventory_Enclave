<?php

namespace App\Http\Controllers;

use App\Models\FurnitureImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FurnitureImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        foreach ($request['image'] as $data) {
            $validatorImage = Validator::make(['image' => $data], ['image' => 'required|image|max:2024']);

            /**
             * run validator image
             */
            if ($validatorImage->fails()) {
                return redirect()->back()->withErrors($validatorImage)->withInput();
            }
        }

        foreach ($request['image'] as $data) {
            if (File::isFile($data)) {
                $image_name = $data->getInode() . time() . "." . $data->getClientOriginalExtension();
                $image_url = url('img/furnitures/' . $image_name);
                $data->move('img/furnitures', $image_name);

                FurnitureImage::create([
                    'furniture_id' => $request['furniture_id'],
                    'name' => $image_name,
                    'url' => $image_url,
                ]);
            }
        }

        return back()->with('success', 'Gambar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(FurnitureImage $furnitureImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FurnitureImage $furnitureImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FurnitureImage $furnitureImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $query = str_replace('/images/' . $id, '', request()->getRequestUri());
        // dd($query);

        $image = FurnitureImage::find($id);

        if (!$image) {
            return back()->with('warning', 'Gambar tidak ditemukan!');
        }

        $images = FurnitureImage::where('furniture_id', $image->furniture_id)->get();

        if ($images->count() <= 1) {
            return back()->with('error', 'Gambar tidak boleh kosong');
        }

        if (File::exists('img/furnitures/' . $image->name)) {
            File::delete('img/furnitures/' . $image->name);
        }

        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus');
    }
}
