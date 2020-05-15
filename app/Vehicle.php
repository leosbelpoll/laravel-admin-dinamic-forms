<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'user_id',
        'project_id',
        'standard_id',
        'no_placa_id',
        'recorrido_inicial',
        'recorrido_inicial_image',
        'recorrido_final',
        'recorrido_final_image',
        'galones_comprados',
        'galones_comprados_image',
        'bomba_abastecimiento_id',
        'sistema_amortiguacion_id',
        'explicacion_capacitacion',
        'estado_medicion_id',
        'presion_neumaticos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    public function noPlaca()
    {
        return $this->belongsTo(NoPlaca::class);
    }

    public function bombaAbastecimiento()
    {
        return $this->belongsTo(BombaAbastecimiento::class);
    }

    public function sistemaAmortiguacion()
    {
        return $this->belongsTo(SistemaAmortiguacion::class);
    }

    public function estadoMedicion()
    {
        return $this->belongsTo(EstadoMedicion::class);
    }
}
