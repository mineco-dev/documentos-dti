<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        User::where('id', $id)->update($request->all());
        return response()->json("Usuario actualizado", 200);
    }
}
