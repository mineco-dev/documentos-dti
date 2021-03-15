<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DependenciaStoreRequest;
use App\Http\Requests\DependenciaUpdateRequest;
use App\Models\Dependencia;

class DependenciaController extends Controller
{
    public function index(Request $request)
    {
        if($request->format == "vue-select") {
            return response()->json(Dependencia::
                select('id as code', 'name as label')
                ->orderBy('name', 'ASC')
                ->get(), 200);
        }
        
    	return response()->json(Dependencia::orderBy('name', 'ASC')->paginate($request->paginate), 200);
    }

    public function store(DependenciaStoreRequest $request)
    {
    	$dependencia = Dependencia::create($request->all());
    	return response()->json("Se creo la dependencia: $dependencia->name", 200);
    }

    public function show($id)
    {
    	return response()->json(Dependencia::findOrFail($id), 200);
    }

    public function update(DependenciaUpdateRequest $request, $id)
    {
    	Dependencia::find($id)->update($request->all());
    	return response()->json("Dependencia actualizado", 200);
    }
}
