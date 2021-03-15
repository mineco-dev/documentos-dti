<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaludoStoreRequest;
use App\Http\Requests\SaludoUpdateRequest;
use App\Models\Saludo;

class SaludoController extends Controller
{
    public function index(Request $request)
    {
        if($request->format == "vue-select") {
            return response()->json(Saludo::
                select('id as code', 'name as label')
                ->orderBy('name', 'ASC')
                ->get(), 200);
        }
        
    	return response()->json(Saludo::orderBy('name', 'ASC')->paginate($request->paginate), 200);
    }

    public function store(SaludoStoreRequest $request)
    {
    	$saludo = Saludo::create($request->all());
    	return response()->json("Se creo el saludo: $saludo->name", 200);
    }

    public function show($id)
    {
    	return response()->json(Saludo::findOrFail($id), 200);
    }

    public function update(SaludoUpdateRequest $request, $id)
    {
    	Saludo::find($id)->update($request->all());
    	return response()->json("Saludo actualizado", 200);
    }
}
