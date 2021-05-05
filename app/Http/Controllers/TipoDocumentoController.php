<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TipoDocumentoUpdateRequest;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{
	public function index()
	{
		return response()->json(TipoDocumento::all(), 200);
	}
	
	public function update(TipoDocumentoUpdateRequest $request, $id)
	{
		TipoDocumento::where('id', $id)->update([
			'name' => $request->name,
			'prefix' => $request->prefix,
			'correlativo' => $request->correlativo,
			'anio' => $request->anio,
		]);
		return response()->json("Documento actualizado", 200);
	}
}
