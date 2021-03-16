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
			leftJoin('users AS u', 'asignaciones.user_id', 'u.id')
			->leftJoin('tipo_documentos AS td', 'asignaciones.tipo_documento_id', 'td.id')
			->leftJoin('estado_documentos AS ed', 'asignaciones.estado_documento_id', 'ed.id')
			->select([
				'asignaciones.id',
				'asignaciones.documento_id',
				'asignaciones.anio',
				'asignaciones.asunto',
				'asignaciones.file',
				'asignaciones.file_referencia',
				'asignaciones.estado_documento_id',
				'asignaciones.created_at',
				'u.name AS responsable',
				'td.prefix',
				'ed.name AS estado'
			])
			->orderBy('asignaciones.anio', 'DESC')
			->orderBy('asignaciones.documento_id', 'DESC')
			->paginate(10), 200);
	}

	public function store(Request $request)
	{
		DB::beginTransaction();

		try {
			$id = DB::table($request->type)->insertGetId([]);
			$director_id = DB::table('users')->where('es_director', 1)->select('id')->first()->id;

			$oficio = Asignacion::create([
				'documento_id' => $id,
				'anio' =>  date("Y"),
				'fecha_emision' => $request->fecha_emision,
				'asunto' => $request->asunto,
				'destinatario_id' => $request->destinatario_id,
				'respuesta' => $request->respuesta,
				'referencia' => $request->referencia,
				'tipo_documento_id' => 1,
				'user_id' => $request->user()->id,
				'director_actual' => $director_id
			]);

			if($request->file('file_referencia')) {
				$hash_pdf = "$oficio->id-";
				$hash_pdf = $hash_pdf . \Str::random(7);;
				$path = $request->file_referencia->storeAs("public/oficios/$oficio->anio", "$hash_pdf.pdf");

				$oficio->file_referencia = $path;
				$oficio->save();
			}

			DB::commit();

			return response()->json("El documento fue asignado", 200);
			
		} catch (ErrorException $e) {
			DB::rollback();
			return response()->json($e, 500);
		}
	}

	public function show(Request $request, $id)
	{
		if($request->type == 'flat') {
			return Asignacion::findOrFail($id);
		}

		$documento = Asignacion::
		join('tipo_documentos AS td', 'asignaciones.tipo_documento_id', 'td.id')
		->join('destinatarios AS ds', 'asignaciones.destinatario_id', 'ds.id')
		->join('saludos AS s', 'ds.saludo_id', 's.id')
		->join('dependencias AS d', 'ds.dependencia_id', 'd.id')
		->select([
			'asignaciones.id',
			'asignaciones.documento_id',
			'asignaciones.anio',
			'asignaciones.fecha_emision',
			'asignaciones.asunto',
			'asignaciones.respuesta',
			'asignaciones.referencia',
			'td.name AS tipo',
			'td.prefix',
			'ds.name AS destinatario',
			's.name AS destinatario_saludo',
			'd.name AS destinatario_dependencia',
		])
		->where('asignaciones.id', $id)
		->first();

		if(!isset($documento)) {
			return response()->json("Documento no encontrado", 404);
		}
		
		return response()->json($documento, 200);
	}

	public function upload(Request $request, $id)
	{
		DB::beginTransaction();
		try {
			$DOCUMENTO_CARGADO = 2;

			$oficio = Asignacion::findOrFail($id);

			\Storage::delete($oficio->file);

			$hash_pdf = "$id-";
			$hash_pdf = $hash_pdf . \Str::random(7);;
			$path = $request->pdf->storeAs("public/oficios/$oficio->anio", "$hash_pdf.pdf");

			$oficio->file = $path;
			$oficio->estado_documento_id = $DOCUMENTO_CARGADO;
			$oficio->save();
			DB::commit();
			return response()->json("Documento cargado", 200);
			
		} catch (\Exception $e) {
			DB::rollback();
			return response()->json($e->getMessage(), 500);
		}
	}

	public function archivar(Request $request, $id)
	{
		$DOCUMENTO_ARCHIVADO = 3;
		$oficio = Asignacion::findOrFail($id);
		$oficio->estado_documento_id = $DOCUMENTO_ARCHIVADO;

		if(!$oficio->save()) {
			return response()->json("El documento no pudo ser archivado", 500);
		}

		return response()->json("Documento archivado", 200);
	}
}
