<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/User/Index',
        [
            'users' => User::all()
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
    public function edit(User $user)
    {
        return inertia('Admin/User/Edit',[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update(
            $request->validate([
                'name' => 'required',
                'cpf' => 'nullable|cpf|unique:users',
                'cnpj' => 'nullable|cnpj|unique:users',
            ])
        );
        return redirect()->route('admin.user.index')->with('success', 'User saved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //$this->endDate = now(); $this->save(); // Prevent the actual delete return false;
        $user->endDate = now();
        $user->save();
        return redirect()->back()->with('success', 'User was deleted!');
    }
}
