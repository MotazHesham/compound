<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartyBooking extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function party(){
        return $this->belongsTo(Party::class,'party_id');
    }
}
