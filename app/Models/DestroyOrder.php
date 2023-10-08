<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestroyOrder extends Model
{
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function super(){
        return $this->belongsTo(Admin::class,'super_id');
    }

    public function Piece(){
        return $this->belongsTo(Piece::class,'piece_id');
    }
}
