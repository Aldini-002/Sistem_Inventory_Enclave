<?php

namespace App\Http\Controllers;

use App\Models\Material2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Material2Controller extends Controller
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
        $material2s = Material2::filter(request(['search']))->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('material2s.index', [
            'page' => 'material2s',
            'material2s' => $material2s,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material2s.create', [
            'page' => 'material2s',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:material2,name',
            'sku' => 'required|unique:material2,sku'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Material2::create([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        return redirect('/material2s?orderBy=newest')->with('success', 'Material berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material2 $material2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $material2 = Material2::find($id);

        if (!$material2) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material2['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa diubah');
        }

        return view('material2s.edit', [
            'page' => 'material2s',
            'material2' => $material2,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $material2 = Material2::find($id);

        if (!$material2) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material2['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa diubah');
        }

        $validatorRules = [
            'name' => 'required',
            'sku' => 'required',
        ];

        if ($req->name != $material2->name) {
            $validatorRules['name'] = 'required|unique:material2,name';
        }

        if ($req->sku != $material2->sku) {
            $validatorRules['sku'] = 'required|unique:material2,sku';
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $material2->update([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        $query = str_replace('/material2s/' . $id, '', request()->getRequestUri());

        return redirect('/material2s/' . $query)->with('success', 'Material berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $material2 = Material2::find($id);

        if (!$material2) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material2['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa dihapus');
        }

        $material2->delete();

        $query = str_replace('/material2s/' . $id, '', request()->getRequestUri());
        return redirect('/material2s' . $query)->with('success', 'Material berhasil dihapus');
    }
}
