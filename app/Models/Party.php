<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tenants(){
        return $this->belongsToMany(Tenant::class,'party_bookings','party_id','tenant_id')
            ->withPivot('numbers','created_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bus(){
        return $this->belongsTo(Bus::class,'bus_id');
    }
}
