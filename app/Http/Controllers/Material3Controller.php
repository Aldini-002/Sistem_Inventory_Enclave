<?php

namespace App\Http\Controllers;

use App\Models\Material3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Material3Controller extends Controller
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
        $material3s = Material3::filter(request(['search']))->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('material3s.index', [
            'page' => 'material3s',
            'material3s' => $material3s,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material3s.create', [
            'page' => 'material3s',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:material3,name',
            'sku' => 'required|unique:material3,sku'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Material3::create([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        return redirect('/material3s?orderBy=newest')->with('success', 'Material berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material3 $material3)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $material3 = Material3::find($id);

        if (!$material3) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material3['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa diubah');
        }

        return view('material3s.edit', [
            'page' => 'material3s',
            'material3' => $material3,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $material3 = Material3::find($id);

        if (!$material3) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material3['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa diubah');
        }

        $validatorRules = [
            'name' => 'required',
            'sku' => 'required',
        ];

        if ($req->name != $material3->name) {
            $validatorRules['name'] = 'required|unique:material3,name';
        }

        if ($req->sku != $material3->sku) {
            $validatorRules['sku'] = 'required|unique:material3,sku';
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $material3->update([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        $query = str_replace('/material3s/' . $id, '', request()->getRequestUri());

        return redirect('/material3s/' . $query)->with('success', 'Material berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $material3 = Material3::find($id);

        if (!$material3) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material3['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa dihapus');
        }

        $material3->delete();

        $query = str_replace('/material3s/' . $id, '', request()->getRequestUri());
        return redirect('/material3s' . $query)->with('success', 'Material berhasil dihapus');
    }
}
