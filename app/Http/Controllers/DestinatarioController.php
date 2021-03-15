<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DestinatarioStoreRequest;
use App\Http\Requests\DestinatarioUpdateRequest;
use App\Models\Destinatario;
use DB;

class DestinatarioController extends Controller
{
    public function index(Request $request)
    {
        if($request->format == "vue-select") {
            return response()->json(Destinatario::
                leftJoin('saludos', 'destinatarios.saludo_id', 'saludos.id')
                ->join('dependencias', 'destinatarios.dependencia_id', 'dependencias.id')
                ->join('entidades', 'destinatarios.entidad_id', 'entidades.id')
                ->join('cargos', 'destinatarios.cargo_id', 'cargos.id')
                ->select([
                    'destinatarios.id as code',
                    DB::raw("CONCAT(saludos.name, ' ', destinatarios.name, ' - ', cargos.name,', ', dependencias.name, ', ', entidades.name) AS label")
                ])
                ->orderBy('destinatarios.name', 'ASC')
                ->get(), 200);
        }

        return response()->json(Destinatario::
            leftJoin('saludos', 'destinatarios.saludo_id', 'saludos.id')
            ->join('dependencias', 'destinatarios.dependencia_id', 'dependencias.id')
            ->join('entidades', 'destinatarios.entidad_id', 'entidades.id')
            ->join('cargos', 'destinatarios.cargo_id', 'cargos.id')
            ->select([
                'destinatarios.id',
                'destinatarios.name',
                'saludos.name as saludo',
                'dependencias.name as dependencia',
                'entidades.name as entidad',
                'cargos.name as cargo',
            ])
            ->orderBy('name', 'ASC')->paginate($request->paginate), 200);
    }

    public function store(DestinatarioStoreRequest $request)
    {
    	$destinatario = Destinatario::create($request->all());
    	return response()->json("Se creo el destinatario: $destinatario->name", 200);
    }

    public function show($id)
    {
    	return response()->json(Destinatario::findOrFail($id), 200);
    }

    public function update(DestinatarioUpdateRequest $request, $id)
    {
    	Destinatario::find($id)->update($request->all());
    	return response()->json("Destinatario actualizado", 200);
    }
}
