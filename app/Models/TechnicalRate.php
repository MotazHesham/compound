<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalRate extends Model
{ 
    public function technical(){
        return $this->belongsTo(Admin::class,'technical_id');
    }

    public function tenant(){
        return $this->belongsTo(Tenant::class,'tenant_id');
    }

    public function order(){
        return $this->belongsTo(order::class,'order_id');
    }
}
