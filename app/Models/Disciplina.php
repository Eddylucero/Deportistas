<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'disciplina';
    protected $primaryKey = 'iddisciplina';
    public $timestamps = false;

    protected $fillable = ['nombredisciplina'];

    public function deportistas()
    {
        return $this->hasMany(Deportista::class, 'iddisciplina', 'iddisciplina');
    }
}
