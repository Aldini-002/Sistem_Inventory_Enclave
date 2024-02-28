<?php

namespace App\Http\Controllers;

use App\Models\Material4;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Material4Controller extends Controller
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
        $material4s = Material4::filter(request(['search']))->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('material4s.index', [
            'page' => 'material4s',
            'material4s' => $material4s,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material4s.create', [
            'page' => 'material4s',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:material4,name',
            'sku' => 'required|unique:material4,sku'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Material4::create([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        return redirect('/material4s?orderBy=newest')->with('success', 'Material berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material4 $material4)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $material4 = Material4::find($id);

        if (!$material4) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material4['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa diubah');
        }

        return view('material4s.edit', [
            'page' => 'material4s',
            'material4' => $material4,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $material4 = Material4::find($id);

        if (!$material4) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material4['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa diubah');
        }

        $validatorRules = [
            'name' => 'required',
            'sku' => 'required',
        ];

        if ($req->name != $material4->name) {
            $validatorRules['name'] = 'required|unique:material4,name';
        }

        if ($req->sku != $material4->sku) {
            $validatorRules['sku'] = 'required|unique:material4,sku';
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $material4->update([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        $query = str_replace('/material4s/' . $id, '', request()->getRequestUri());

        return redirect('/material4s/' . $query)->with('success', 'Material berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $material4 = Material4::find($id);

        if (!$material4) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material4['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa diubah');
        }

        $material4->delete();

        $query = str_replace('/material4s/' . $id, '', request()->getRequestUri());
        return redirect('/material4s' . $query)->with('success', 'Material berhasil dihapus');
    }
}
