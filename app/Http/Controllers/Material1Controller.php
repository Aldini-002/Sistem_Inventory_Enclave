<?php

namespace App\Http\Controllers;

use App\Models\Material1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Material1Controller extends Controller
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
        $material1s = Material1::filter(request(['search']))->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('material1s.index', [
            'page' => 'material1s',
            'material1s' => $material1s,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material1s.create', [
            'page' => 'material1s',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:material1,name',
            'sku' => 'required|unique:material1,sku'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Material1::create([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        return redirect('/material1s?orderBy=newest')->with('success', 'Material berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material1 $material1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $material1 = Material1::find($id);

        if (!$material1) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material1['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa diubah');
        }

        return view('material1s.edit', [
            'page' => 'material1s',
            'material1' => $material1,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $material1 = Material1::find($id);

        if (!$material1) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material1['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa diubah');
        }

        $validatorRules = [
            'name' => 'required',
            'sku' => 'required',
        ];

        if ($req->name != $material1->name) {
            $validatorRules['name'] = 'required|unique:material1,name';
        }

        if ($req->sku != $material1->sku) {
            $validatorRules['sku'] = 'required|unique:material1,sku';
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $material1->update([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        $query = str_replace('/material1s/' . $id, '', request()->getRequestUri());

        return redirect('/material1s/' . $query)->with('success', 'Material berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $material1 = Material1::find($id);

        if (!$material1) {
            return back()->with('warning', 'Material tidak ditemukan');
        } elseif ($material1['sku'] == 0) {
            return back()->with('warning', 'Material default tidak bisa dihapus');
        }

        $material1->delete();

        $query = str_replace('/material1s/' . $id, '', request()->getRequestUri());
        return redirect('/material1s' . $query)->with('success', 'Material berhasil dihapus');
    }
}
