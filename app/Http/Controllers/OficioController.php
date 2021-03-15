<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oficio;
use App\Models\Asignacion;
use App\Models\User;
use DB;

class OficioController extends Controller
{
	public function index(Request $request)
	{
		return response()->json(Asignacion::
			join('tipo_documentos', 'asignaciones.tipo_documento_id', 'tipo_documentos.id')->paginate(10), 200);
	}

	public function store(Request $request)
	{
		DB::beginTransaction();

		try {
			$id = DB::table($request->type)->insertGetId([]);
			$director_id = DB::table('users')->where('es_director', 1)->select('id')->first()->id;

			Asignacion::create([
				'documento_id' => $id,
				'anio' =>  date("Y"),
				'fecha_emision' => $request->fecha_emision,
				'asunto' => $request->asunto,
				'destinatario_id' => $request->destinatario_id,
				'respuesta' => $request->respuesta,
				'file' => $request->file,
				'referencia' => $request->referencia,
				'file_referencia' => $request->file_referencia,
				'tipo_documento_id' => 1,
				'user_id' => $request->user()->id,
				'director' => $director_id
			]);

			DB::commit();

			return response()->json("El documento fue asignado", 200);
			
		} catch (ErrorException $e) {
			DB::rollback();
			return response()->json($e, 500);
		}
	}

	public function show(Request $request, $id)
	{
		$documento = DB::table("asignaciones as doc")
			->join('tipo_documentos AS td', 'doc.tipo_documento_id', 'td.id')
			->join('destinatarios AS ds', 'doc.destinatario_id', 'ds.id')
			->join('saludos AS s', 'ds.saludo_id', 's.id')
			->join('dependencias AS d', 'ds.dependencia_id', 'd.id')
			->select([
				'doc.id',
				'doc.documento_id',
				'doc.anio',
				'doc.fecha_emision',
				'doc.asunto',
				'doc.respuesta',
				'doc.referencia',
				'td.name AS tipo',
				'td.prefix',
				'ds.name AS destinatario',
				's.name AS destinatario_saludo',
				'd.name AS destinatario_dependencia',
			])
			->where('doc.id', $id)
			->first();

		if(!isset($documento)) {
			return response()->json("Documento no encontrado", 404);
		}
		
		return response()->json($documento, 200);
	}
}
