<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Asignacion;
use App\Notifications\RecordatorioDeDocumentosPendientesDeAdjuntarNotify;
use DB;

class RecordatorioDeDocumentosPendientesDeAdjuntar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dti:recordatorio-pendientes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía correo electrónico a la secretaria con listado de documentos pendientes de adjuntar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
   public function handle()
    {
        $FECHA_COMIENZO_RECORDATORIO = '2021-03-09';
        //$ELMER_ID = 14;
        //$user = User::find($ELMER_ID);

        //$user->notify(new RecordatorioDeDocumentosPendientesDeAdjuntarNotify);

        $documentos_pendientes = Asignacion::
        join('tipo_documentos AS td', 'asignaciones.tipo_documento_id', 'td.id')
        ->select([
            'asignaciones.id',
            'asignaciones.correlativo',
            'asignaciones.documento_id',
            'asignaciones.anio',
            'asignaciones.user_id',
            'asignaciones.created_at',
            'td.name AS tipo_documento'
        ])
        ->where('asignaciones.estado_documento_id', 1)
        ->orderBy('asignaciones.anio', 'ASC')
        ->orderBy('asignaciones.tipo_documento_id', 'ASC')
        ->orderBy('asignaciones.documento_id', 'ASC')
        ->get();

        $anteriores = $documentos_pendientes->where('created_at', '<', $FECHA_COMIENZO_RECORDATORIO);

        $actuales = $documentos_pendientes->where('created_at', '>=', $FECHA_COMIENZO_RECORDATORIO);

        $secretaria = User::where('departamento_id', 2)->first();

        $usuarios_actuales = User::
        join('asignaciones AS a', 'users.id', 'a.user_id')
        ->select(DB::raw('DISTINCT users.id, users.name, users.email, users.genero_id'))
        ->where('a.estado_documento_id', 1)
        ->where('a.created_at', '>=', $FECHA_COMIENZO_RECORDATORIO)
        ->get();

        if(count($anteriores) > 0) {
            $secretaria->notify(new RecordatorioDeDocumentosPendientesDeAdjuntarNotify($anteriores));
        }

        foreach ($usuarios_actuales as $usuario) {
            $documentos_usuario = $actuales->where('user_id', $usuario->id);

            if(count($documentos_usuario) > 0) {
                $usuario->notify(new RecordatorioDeDocumentosPendientesDeAdjuntarNotify($documentos_usuario));
            }
        }
    }
}
