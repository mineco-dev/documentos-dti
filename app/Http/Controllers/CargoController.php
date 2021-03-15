<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CargoStoreRequest;
use App\Http\Requests\CargoUpdateRequest;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function index(Request $request)
    {
        if($request->format == "vue-select") {
            return response()->json(Cargo::
                select('id as code', 'name as label')
                ->orderBy('name', 'ASC')
                ->get(), 200);
        }
        
    	return response()->json(Cargo::orderBy('name', 'ASC')->paginate($request->paginate), 200);
    }

    public function store(CargoStoreRequest $request)
    {
    	$entidad = Cargo::create($request->all());
    	return response()->json("Se creo la entidad: $entidad->name", 200);
    }

    public function show($id)
    {
    	return response()->json(Cargo::findOrFail($id), 200);
    }

    public function update(CargoUpdateRequest $request, $id)
    {
    	Cargo::find($id)->update($request->all());
    	return response()->json("Cargo actualizado", 200);
    }
}
