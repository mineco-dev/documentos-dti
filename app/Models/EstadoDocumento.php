<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoDocumento extends Model
{
    //use HasFactory;

    protected $table = 'estado_documentos';

    protected $fillable = ['name'];
}
