<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tenant extends Authenticatable
{
    use HasApiTokens ;

    protected $guard = 'Tenant';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function villa(){
        return $this->belongsTo(Villas::class,'villa_id');
    }

    /***
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function montior(){
        return $this->hasMany(Monitors::class,'tenant_id');
    }
}
