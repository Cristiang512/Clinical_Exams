<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manejos_extintores extends Model
{
    // use HasFactory;
    protected $table='resultado';
    public $timestamps=false;
    protected $fillable = [
        'document',
        'user_id',
        'fecha_subida',
        'service_id',
        'specialty_id',
    ];
    // protected $fillable = [
    //     'document', 'user_id', 'fecha_subida', 'servicio_id','estado'
    //   ];
    // protected $primaryKey = 'resultado_id';

    // public function tipoext(){
    //      return $this->belongsTo('App\Models\Tipos_extintores', 'tipo_extintor', 'id_extintor');
    // }

}
