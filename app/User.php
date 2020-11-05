<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'cargo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

//    protected $with = ["cargo"];
    /**
     * Relação cargo pertence a u departamento
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cargo(){
        return $this->belongsTo("App\Cargo", "idCargo");
    }

}
