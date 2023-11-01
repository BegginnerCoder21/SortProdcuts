<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {

        $products = Product::with('category')
            ->when(
                request('orderBy') == 'category',
                fn ($query,$criteria) => $query->orderBy(
                    Category::select('name')->where('id','products.category_id')->get(),request('direction')
                )
            )

            ->when(
                request('orderBy'),
                fn ($query,$criteria) => $query->orderBy(
                   $criteria,request('direction')
                )
            )
            ->get();

        return response()->json([
            'products' => $products
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
