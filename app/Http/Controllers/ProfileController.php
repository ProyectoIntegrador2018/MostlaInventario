<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function campus(Request $request)
    {
        $request->validate(['campus_id' => 'required|integer|exists:campus,id']);

        auth()->user()->setCampus($request->campus_id);

        return back();
    }
}
