<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use Illuminate\Http\Request;

class FurnitureApiController extends Controller
{
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

        return response()->json($furnitures);
    }
}
