<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EntidadStoreRequest;
use App\Http\Requests\EntidadUpdateRequest;
use App\Models\Entidad;

class EntidadController extends Controller
{
    public function index(Request $request)
    {
        if($request->format == "vue-select") {
            return response()->json(Entidad::
                select('id as code', 'name as label')
                ->orderBy('name', 'ASC')
                ->get(), 200);
        }
        
    	return response()->json(Entidad::orderBy('name', 'ASC')->paginate($request->paginate), 200);
    }

    public function store(EntidadStoreRequest $request)
    {
    	$entidad = Entidad::create($request->all());
    	return response()->json("Se creo la entidad: $entidad->name", 200);
    }

    public function show($id)
    {
    	return response()->json(Entidad::findOrFail($id), 200);
    }

    public function update(EntidadUpdateRequest $request, $id)
    {
    	Entidad::find($id)->update($request->all());
    	return response()->json("Entidad actualizado", 200);
    }
}
