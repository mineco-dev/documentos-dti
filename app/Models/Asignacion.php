<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    // use HasFactory;

	protected $table = 'asignaciones';

	protected $fillable = [
		'documento_id',
		'anio',
		'fecha_emision',
		'asunto',
		'destinatario_id',
		'respuesta',
		'file',
		'referencia',
		'file_referencia',
		'tipo_documento_id',
		'estado_documento_id',
		'user_id',
		'director_actual'
	];

	protected $appends = [
		'file_url',
		'file_referencia_url'
	];

	public function getFileUrlAttribute()
	{
		//return null;
		//return "http://www.orimi.com/pdf-test.pdf";
		return $this->file ? \Storage::url($this->file) : null;
	}

	public function getFileReferenciaUrlAttribute()
	{
		//return "archivo";
		return $this->file_referencia ? \Storage::url($this->file_referencia) : null;
	}
}
