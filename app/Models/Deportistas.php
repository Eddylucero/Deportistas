<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deportistas extends Model
{
    protected $table = 'deportista';
    protected $primaryKey = 'iddeportista';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'fechanacimiento',
        'estatura',
        'peso',
        'idpais',
        'iddisciplina'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'idpais');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'iddisciplina');
    }
}
