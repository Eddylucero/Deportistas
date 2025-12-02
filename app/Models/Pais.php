<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Deportistas;

class Pais extends Model
{
    protected $table = 'pais';
    protected $primaryKey = 'idpais';
    public $timestamps = false;

    protected $fillable = ['nombrepais'];

    public function deportistas()
    {
        return $this->hasMany(Deportistas::class, 'idpais', 'idpais');
    }
}
