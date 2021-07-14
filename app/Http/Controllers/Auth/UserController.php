<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\UpdateUserProfileInformation;
use App\Models\Asignacion;

class UserController extends Controller
{
    public function user(Request $request)
    {
    	return $request->user();
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UpdateUserProfileInformation $updater)
    {
        return response()->json($updater->update($request->user(), $request->all()), 200);
    }

    public function misDocumentos(Request $request)
    {
        return response()->json(Asignacion::
            leftJoin('users AS u', 'asignaciones.user_id', 'u.id')
            ->leftJoin('tipo_documentos AS td', 'asignaciones.tipo_documento_id', 'td.id')
            ->leftJoin('estado_documentos AS ed', 'asignaciones.estado_documento_id', 'ed.id')
            ->select([
                'asignaciones.id',
                'asignaciones.correlativo',
                'asignaciones.documento_id',
                'asignaciones.anio',
                'asignaciones.asunto',
                'asignaciones.file',
                'asignaciones.file_referencia',
                'asignaciones.estado_documento_id',
                'asignaciones.destinatario_id',
                'asignaciones.created_at',
                'u.name AS responsable',
                'td.prefix',
                'td.directory',
                'ed.name AS estado'
            ])
            ->where('asignaciones.user_id', $request->user_id)
            ->where('asignaciones.tipo_documento_id', $request->tipo_documento_id)
            ->orderBy('asignaciones.anio', 'DESC')
            ->orderBy('asignaciones.documento_id', 'DESC')
            ->paginate($request->per_page), 200);
    }
}
