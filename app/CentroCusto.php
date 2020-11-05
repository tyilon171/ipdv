<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroCusto extends Model
{
    protected $table = "centrocustos";

//    protected $with = ['departamentos'];

    /**
     * Relação Centro de custo possui departamentos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departamentos(){
        return $this->hasMany("App\Departamento", "idCentro");
    }
}
