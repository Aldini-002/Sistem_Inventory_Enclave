<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\Order;
use App\Models\OrderFurniture;
use App\Models\OrderSelect;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderBy = 'created_at';
        $order = 'desc';

        switch (request('orderBy')) {
            case 'newest':
                $orderBy = 'created_at';
                $order = 'desc';
                break;
            case 'oldest':
                $orderBy = 'created_at';
                $order = 'asc';
                break;
            default:
                $orderBy = 'created_at';
                $order = 'desc';
                break;
        }

        $show = request('show') ?? '5';
        $with = ['supplier', 'order_furnitures'];
        $orders = Order::filter(request(['search', 'status']))->with($with)->orderBy($orderBy, $order)->paginate($show)->withQueryString();
        OrderSelect::truncate();

        return view('orders.index', [
            'page' => 'orders',
            'orders' => $orders,
            'allOrders' => Order::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create', [
            'page' => 'orders',
            'suppliers' => Supplier::orderBy('name', 'asc')->get(),
            'order_selects' => OrderSelect::orderBy('created_at', 'desc')->get()
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
            'supplier_id' => $req['supplier_id'],
            'furniture_id' => $req['furniture_id'],
            'no_po' => $req['no_po'],
            'orderer' => Auth::user()->name ?? 'Enclave',
            'deadline' => $req['deadline'],
            'qty' => $req['qty'],
            'price' => $req['price'],
            'total' => $req['total'] ?? 0,
        ];

        /**
         * create rules validator
         */
        $rules = [
            'supplier_id' => 'required',
            'no_po' => 'required',
            'orderer' => 'required',
            'deadline' => 'required',
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

        Order::create([
            'supplier_id' => $fields['supplier_id'],
            'no_po' => $fields['no_po'],
            'orderer' => $fields['orderer'],
            'deadline' => $fields['deadline'],
        ]);

        $order_id = Order::orderBy('created_at', 'desc')->first()->id;
        $fields['order_id'] = $order_id;

        /**
         * order_furniture handle
         */
        foreach ($fields['furniture_id'] as $i => $data) {
            /**
             * create rules validator
             */
            $rules = [
                'order_id' => 'required',
                'furniture_id' => 'required',
                'qty' => 'required',
                'price' => 'required',
                'total' => 'required',
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

            OrderFurniture::create([
                'order_id' => $fields['order_id'],
                'furniture_id' => $data,
                'qty' => $fields['qty'][$i],
                'price' => $fields['price'][$i],
                'total' => sprintf('%.2f', $fields['qty'][$i] * $fields['price'][$i])
            ]);
        }

        OrderSelect::truncate();

        return redirect('/orders?orderBy=newest')->with('success', 'Order berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $with = ['supplier', 'order_furnitures'];
        $order = Order::with($with)->find($id);

        if (!$order) {
            return back()->with('warning', 'order not found!');
        }

        return view('orders.show', [
            'page' => 'orders',
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return back()->with('warning', 'Order tidak ditemukan!');
        }

        /**
         * create fields
         */
        $fields = [
            'status' => $req['status'] ?? $order['status'],
        ];

        /**
         * create rules validator
         */
        $rules = [
            'status' => 'required',
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

        $order->update($fields);

        return back()->with('success', 'Status berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return back()->with('warning', 'Order tidak ditemukan!');
        }

        $order_furnitures = OrderFurniture::where('order_id', $id);

        $order->delete();
        $order_furnitures->delete();

        $query = str_replace('/orders/' . $id, '', request()->getRequestUri());

        return redirect('/orders' . $query)->with('success', 'Order berhasil dihapus');
    }
}
