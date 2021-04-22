<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Asignacion;

class ActualizarEstadoDeAsignacionesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dti:actualizar-estado';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $asignaciones = Asignacion::all();
        foreach($asignaciones as $asignacion) {
            if($asignacion->file == null) {
                $asignacion->estado_documento_id = 1;
            } else {
                $asignacion->estado_documento_id = 2;
            }

            $asignacion->save();
        }
        return 0;
    }
}
