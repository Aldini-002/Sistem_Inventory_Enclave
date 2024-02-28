<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
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
        $suppliers = Supplier::filter(request(['search']))->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('suppliers.index', [
            'page' => 'suppliers',
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create', [
            'page' => 'suppliers',
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
            'name' => $req['name'],
            'phone' => $req['phone'],
            'address' => $req['address'] ?? '-',
            'company' => $req['company'] ?? '-',
            'skill' => $req['skill'] ?? '-',
        ];

        /**
         * create rules validator
         */
        $rules = [
            'name' => 'required|min:3',
            'phone' => 'required|unique:supplier,phone|numeric',
            'address' => 'required',
            'company' => 'required',
            'skill' => 'required',
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

        Supplier::create($fields);

        return redirect('/suppliers?orderBy=newest')->with('success', 'Supplier berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return back()->with('warning', 'supplier not found!');
        }

        return view('suppliers.show', [
            'page' => 'suppliers',
            'supplier' => $supplier,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return back()->with('warning', 'Supplier tidak ditemukan!');
        }

        return view('suppliers.edit', [
            'page' => 'suppliers',
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    { {
            $supplier = Supplier::find($id);

            if (!$supplier) {
                return back()->with('warning', 'Supplier tidak ditemukan!');
            }

            /**
             * create fields
             */
            $fields = [
                'name' => $req['name'] ?? $supplier['name'],
                'phone' => $req['phone'] ?? $supplier['phone'],
                'address' => $req['address'] ?? $supplier['address'],
                'company' => $req['company'] ?? $supplier['company'],
                'skill' => $req['skill'] ?? $supplier['skill'],
            ];

            /**
             * create rules validator
             */
            $rules = [
                'name' => 'required',
                'phone' => 'required|unique:supplier,phone|numeric',
                'address' => 'required',
                'company' => 'required',
                'skill' => 'required',
            ];

            /**
             * update rules
             */
            if ($fields['phone'] == $supplier->phone) {
                $rules['phone'] = 'required|numeric';
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

            $supplier->update($fields);

            $query = str_replace('/suppliers/' . $id, '', request()->getRequestUri());

            return redirect('/suppliers/' . $id . $query)->with('success', 'Supplier berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return back()->with('warning', 'Supplier tidak ditemukan!');
        }

        $supplier->delete();

        $query = str_replace('/suppliers/' . $id, '', request()->getRequestUri());

        return redirect('/suppliers' . $query)->with('success', 'Supplier berhasil dihapus');
    }
}
