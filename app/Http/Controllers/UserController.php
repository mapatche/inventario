<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('active', '1')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(SaveUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $role = Role::where('name', $data['user_role'])->where('guard_name', 'web')->first();

        $user->assignRole($role);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRole = $user->roles->first() ? $user->roles->first()->name : null;

        return view('users.edit', compact('user', 'userRole', 'roles'));
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
