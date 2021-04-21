<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oficio;
use App\Models\Asignacion;
use App\Models\User;
use DB;

class DocumentoController extends Controller
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
			->where('asignaciones.tipo_documento_id', $request->table)
			->orderBy('asignaciones.anio', 'DESC')
			->orderBy('asignaciones.documento_id', 'DESC')
			->paginate($request->per_page), 200);
	}

	public function store(Request $request)
	{
		DB::beginTransaction();

		try {
			$id = DB::table($request->table)->insertGetId([]);
			$director_id = DB::table('users')->where('es_director', 1)->select('id')->first()->id;

			$documento = Asignacion::create([
				'documento_id' => $id,
				'anio' =>  date("Y"),
				'fecha_emision' => $request->fecha_emision,
				'asunto' => $request->asunto,
				'destinatario_id' => $request->destinatario_id,
				'respuesta' => $request->respuesta,
				'referencia' => $request->referencia,
				'tipo_documento_id' => $request->tipo_documento_id,
				'user_id' => $request->user()->id,
				'director_actual' => $director_id
			]);

			if($request->file('file_referencia')) {
				$hash_pdf = "$documento->id-";
				$hash_pdf = $hash_pdf . \Str::random(7);;
				$path = $request->file_referencia->storeAs("public/documentos/$documento->anio", "$hash_pdf.pdf");

				$documento->file_referencia = $path;
				$documento->save();
			}

			DB::commit();

			return response()->json($documento, 200);
			
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

			$documento = Asignacion::findOrFail($id);

			\Storage::delete($documento->file);

			$hash_pdf = "$id-";
			$hash_pdf = $hash_pdf . \Str::random(7);;
			$path = $request->pdf->storeAs("public/documentos/$documento->anio", "$hash_pdf.pdf");

			$documento->file = $path;
			$documento->estado_documento_id = $DOCUMENTO_CARGADO;
			$documento->save();
			DB::commit();
			return response()->json("Documento cargado", 200);
			
		} catch (\Exception $e) {
			DB::rollback();
			return response()->json($e->getMessage(), 500);
		}
	}

	public function update(Request $request, $id)
	{
		DB::beginTransaction();
		try {
			$documento = Asignacion::findOrFail($id);

			$path_file = null;
			if($request->file('file')) {
				\Storage::delete($documento->file);
				$hash_pdf = "$documento->id-";
				$hash_pdf = $hash_pdf . \Str::random(7);;
				$path_file = $request->file->storeAs("public/$request->type/$documento->anio", "$hash_pdf.pdf");

			}

			$path_referencia_file = null;
			if($request->file('file_referencia')) {
				\Storage::delete($documento->file_referencia);
				$hash_pdf = "$documento->id-";
				$hash_pdf = $hash_pdf . \Str::random(7);;
				$path_referencia_file = $request->file_referencia->storeAs("public/$request->type/$documento->anio", "$hash_pdf.pdf");
			}

			if($path_file == null) {
				$path_file = $documento->file;
			}
			$documento->fill([
				'fecha_emision' => $request->fecha_emision,
				'asunto' => $request->asunto,
				'destinatario_id' => $request->destinatario_id,
				'respuesta' => $request->respuesta,
				'file' => $path_file,
				'referencia' => $request->referencia,
				'file_referencia' => $path_referencia_file
			]);

			$documento->save();

			DB::commit();
			return response()->json($documento, 200);
			
		} catch (\Exception $e) {
			DB::rollback();
			return response()->json($e->getMessage(), 500);
		}
	}

	public function archivar(Request $request, $id)
	{
		$DOCUMENTO_ARCHIVADO = 3;
		$documento = Asignacion::findOrFail($id);
		$documento->estado_documento_id = $DOCUMENTO_ARCHIVADO;

		if(!$documento->save()) {
			return response()->json("El documento no pudo ser archivado", 500);
		}

		return response()->json("Archivado", 200);
	}
}
