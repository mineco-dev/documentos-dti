<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinatario extends Model
{
    // use HasFactory;

    protected $fillable = [
    	'saludo_id',
    	'name',
    	'dependencia_id',
    	'entidad_id',
    	'cargo_id',
    ];
}
