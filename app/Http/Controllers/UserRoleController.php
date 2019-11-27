<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\UserRole;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $admin_general = $user->type_id == UserRole::ADMIN_GENERAL;

        $roles = UserRole::when(!$admin_general, function ($query) use ($user) {
            $query->forCampus($user->campus_id)->lessThan($user->type_id);
        })->get();
        $types = UserType::when(!$admin_general, function ($query) use ($user) {
            $query->lesserThan($user->type_id);
        })->get();
        $campus = Campus::all();

        return view('roles.index')->with(compact('roles', 'types', 'campus', 'admin_general'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'type_id' => 'required|integer|exists:user_types,id',
            'campus_id' => 'sometimes|integer|exists:campus,id',
        ]);

        UserRole::create($data);

        return back();
    }

    public function updateType(Request $request, UserRole $role)
    {
        if ($role->email == auth()->user()->email) {
            return back()->with('alert', 'No puede editar su propio rol.');
        }

        $request->validate(['type_id' => 'required|integer|exists:user_types,id']);

        $role->setType($request->type_id);

        return back();
    }

    public function updateCampus(Request $request, UserRole $role)
    {
        if ($role->email == auth()->user()->email) {
            return back()->with('alert', 'No puede editar su propio rol.');
        }
        
        $request->validate(['campus_id' => 'required|integer|exists:campus,id']);

        $role->setCampus($request->campus_id);

        return back();
    }

    public function delete(UserRole $role)
    {
        if ($role->email == auth()->user()->email) {
            return back()->with('alert', 'No puede eliminar su propio rol.');
        }

        $role->delete();

        return back();
    }
}
