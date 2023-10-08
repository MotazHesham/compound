<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party2 extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant(){
        return  $this->belongsTo(Tenant::class,'tenant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(){
        return $this->belongsTo(PartyType::class,'type_id');
    }
}
