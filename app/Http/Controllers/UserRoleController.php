<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use App\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        $roles = UserRole::all();
        $types = UserType::all();

        return view('roles.index')->with(compact('roles', 'types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:user_roles',
            'type_id' => 'required|integer|exists:user_types,id',
        ]);

        UserRole::create($data);

        return back();
    }

    public function update(Request $request, UserRole $role)
    {
        $request->validate(['type_id' => 'required|integer|exists:user_types,id']);

        $role->setType($request->type_id);

        return back();
    }

    public function delete(UserRole $role)
    {
        $role->delete();

        return back();
    }
}
