<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('itemsPerPage', 10);
        $filters = $request->only(['name', 'itemsPerPage']);
        return inertia('Admin/Product/Index',
        [
            'filters' => $filters,
            'products' => Product::latest()
                ->filter($filters)
                ->paginate($perPage)
                ->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Product/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::make($request->validate([
            'name' => 'required',
        ]));
        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Product saved!');
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
    public function edit(Product $product)
    {
        return inertia('Admin/Product/Edit',[
            'product' => $product
        ]);
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
    public function destroy(Product $product)
    {
        //$this->endDate = now(); $this->save(); // Prevent the actual delete return false;
        $product->endDate = now();
        $product->save();
        return redirect()->back()->with('success', 'Product was deleted!');
    }
}
