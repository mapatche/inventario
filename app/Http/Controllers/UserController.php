<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('active', '1')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(SaveUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $user->assignRole($data['user_role']);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $user)
    {
        $userRole = $user->roles->first() ? $user->roles->first()->name : null;

        return view('users.edit', compact('user', 'userRole'));
    }

    public function update(SaveUserRequest $request, User $user)
    {
        $data = $request->validated();
        if (empty($data['password'])) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }
        $user->update($data);
        $user->syncRoles($data['user_role']);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        $user->update(['active' => '0']);

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
