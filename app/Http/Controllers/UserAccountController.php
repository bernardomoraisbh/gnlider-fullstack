<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }

    public function edit(User $user)
    {
        return inertia('UserAccount/Edit',[
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $user = User::make($request->validate([
            'name' => 'required',
            'surName' => 'required',
            'birthDate' => 'nullable|date|before:today',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'cpf' => 'nullable|cpf|unique:users',
            'cnpj' => 'nullable|cnpj|unique:users',
            'cellphone' => 'required',
            'regional_council_number' => 'nullable',
            'state_inscription_number' => 'nullable',
            'regional_council_state_id' => 'nullable',
        ]));
        $user->save();
        Auth::login($user);
        return redirect()->route('/')
            ->with('success', 'Account created!');
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
}
