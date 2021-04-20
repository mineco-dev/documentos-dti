<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;
use DB;
use Mpdf\Mpdf;

class AsignacionController extends Controller
{
	public function generarPdf($id)
	{
		$documento = Asignacion::
		select([
			'td.prefix',
			'td.name AS tipo_documento',
			'td.directory',
			'd.name AS destinatario',
			's.name AS saludo',
			'd2.name AS dependencia',
			'e.name AS entidad',
			'c.name AS cargo',
			'asignaciones.asunto',
			'asignaciones.fecha_emision',
			'asignaciones.respuesta',
			'asignaciones.file',
			'asignaciones.documento_id',
			'asignaciones.anio',
			'asignaciones.tipo_documento_id'
		])
		->join('tipo_documentos AS td', 'asignaciones.tipo_documento_id', 'td.id')
		->join('destinatarios AS d', 'asignaciones.destinatario_id', 'd.id')
		->join('saludos AS s', 'd.saludo_id', 's.id')
		->join('dependencias AS d2', 'd.dependencia_id', 'd2.id')
		->join('entidades AS e', 'd.entidad_id', 'e.id')
		->join('cargos AS c', 'd.cargo_id', 'c.id')
		->findOrFail($id);

		$mpdf = new Mpdf(['format' => 'letter']);
		$html = \View::make('formatos.'. $documento->tipo_documento_id, compact('documento'));
		$mpdf->WriteHTML($html);
		$path = "$documento->directory";
		$path .= '/'.date('Y');
		$path .= "/$documento->documento_id";
		$path .= "-$documento->anio";
		$path .= "_";
		$path .= \Str::random(7);
		$path .= ".pdf";
		\Storage::delete($documento->file);
		\Storage::disk('public')->put($path, $mpdf->Output('',"S"));
		Asignacion::where('id', $id)->update([
			'file' => 'public/'. $path
		]);
		return response()->json('storage/'. $path, 200);
	}
}