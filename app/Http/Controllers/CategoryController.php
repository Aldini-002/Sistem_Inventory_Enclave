<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        $categories = Category::filter(request(['search']))->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('categories.index', [
            'page' => 'categories',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create', [
            'page' => 'categories',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:category,name',
            'sku' => 'required|unique:category,sku'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Category::create([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        return redirect('/categories?orderBy=newest')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return back()->with('warning', 'Kategori tidak ditemukan');
        } elseif ($category['sku'] == 0) {
            return back()->with('warning', 'Kategori default tidak bisa diubah');
        }

        return view('categories.edit', [
            'page' => 'categories',
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return back()->with('warning', 'Kategori tidak ditemukan');
        } elseif ($category['sku'] == 0) {
            return back()->with('warning', 'Kategori default tidak bisa diubah');
        }

        $validatorRules = [
            'name' => 'required',
            'sku' => 'required',
        ];

        if ($req->name != $category->name) {
            $validatorRules['name'] = 'required|unique:category,name';
        }

        if ($req->sku != $category->sku) {
            $validatorRules['sku'] = 'required|unique:category,sku';
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category->update([
            'name' => $req['name'],
            'sku' => $req['sku']
        ]);

        $query = str_replace('/categories/' . $id, '', request()->getRequestUri());

        return redirect('/categories/' . $query)->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return back()->with('warning', 'Kategori tidak ditemukan');
        } elseif ($category['sku'] == 0) {
            return back()->with('warning', 'Kategori default tidak bisa diubah');
        }

        $category->delete();

        $query = str_replace('/categories/' . $id, '', request()->getRequestUri());
        return redirect('/categories' . $query)->with('success', 'Kategori berhasil dihapus');
    }
}
