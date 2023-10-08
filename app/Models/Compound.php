<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compound extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   public function villas()
   {
       return $this->hasMany('App\Models\Villas','compound_id');
   }
}
