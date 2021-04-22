<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EstadisticaController extends Controller
{
    public function conteo(Request $request)
    {
        if($request->value == 'date("Y")') {
            $request->value = date("Y");
        }
        
    	$conteos = DB::table('asignaciones AS a')
    	->select([
    		'td.name AS tipo_documento',
    		DB::raw('COUNT(a.id) AS total')
    	])
    	->join('tipo_documentos AS td', 'a.tipo_documento_id', 'td.id')
    	->where("a.$request->column", $request->value)
        ->groupBy('td.name')
    	->get();

    	return response()->json($conteos, 200);
    }
}
