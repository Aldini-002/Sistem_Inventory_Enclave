<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Furniture;
use App\Models\Material1;
use App\Models\Material2;
use App\Models\Material3;
use App\Models\Material4;
use App\Models\OrderSelect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderSelectController extends Controller
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
        $with = ['applications', 'category', 'material1', 'material2', 'material3', 'material4', 'finishings', 'furniture_images'];
        $furnitures = Furniture::filter(request(['category', 'material1', 'material2', 'material3', 'material4', 'search']))->with($with)->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('orders.select', [
            'page' => 'orders',
            'furnitures' => $furnitures,
            'order_selects' => OrderSelect::with('furniture')->orderBy('created_at', 'desc')->get(),
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
        //
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
            'furniture_id' => $req['furniture_id'],
        ];

        /**
         * create rules validator
         */
        $rules = [
            'furniture_id' => 'required|unique:order_select,furniture_id|numeric',
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

        OrderSelect::create($fields);

        return back()->with('success', '1 item dipilih');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderSelect $orderSelect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderSelect $orderSelect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderSelect $orderSelect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if ($id == 'cancel') {
            OrderSelect::truncate();
            return redirect('/orders');
        }

        $order_select = OrderSelect::find($id);

        if (!$order_select) {
            return back()->with('warning', 'Data tidak ditemukan!');
        }

        $order_select->delete();

        return back()->with('success', '1 item batal dipilih');
    }
}
