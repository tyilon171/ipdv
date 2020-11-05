<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{

    protected $table = "cargos";

//    protected $with = ["users", "departamento"];
    /**
     * Relação cargo pertence a u departamento
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento(){
        return $this->belongsTo("App\Departamento", "idDepartamento");
    }

    /**
     * Relação cargo possui usuarios
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(){
        return $this->hasMany("App\User", 'idDepartamento');
    }
}
