<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{

//    protected $with = ['cargos', 'centroCusto'];

    protected $table = "departamentos";
    /**
     * Relação departamento pertence ao centro de custo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centroCusto(){
        return $this->belongsTo("App\CentroCusto", 'idCentro');
    }

    /**
     * Relação departamento possui cargos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cargos(){
        return $this->hasMany("App\Cargo", "idDepartamento");
    }
}
