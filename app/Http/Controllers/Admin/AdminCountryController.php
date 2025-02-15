<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class AdminCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('itemsPerPage', 10);
        $filters = $request->only(['name', 'code', 'itemsPerPage']);
        return inertia('Admin/Country/Index',
        [
            'filters' => $filters,
            'countries' => Country::latest()
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
        return inertia('Admin/Country/Create',[]);
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
    public function edit(Country $country)
    {
        return inertia('Admin/Country/Edit',[
            'country' => $country
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
    public function destroy(Country $country)
    {
        $country->endDate = now();
        $country->save();
        return redirect()->back()->with('success', 'Country was deleted!');
    }
}
