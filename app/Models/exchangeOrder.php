<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exchangeOrder extends Model
{
    public const STATUS_SELECT = [
        '1' => 'مقبولة',
        '2' => 'غير مقبولة', 
        '3' => 'قيد المراجعة', 
    ];
    public const TYPE_SELECT = [
        '1' => 'جديدة',
        '2' => 'مستعملة',  
    ];
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function technical(){
        return $this->belongsTo(Admin::class,'technical_id');
    }

    public function Piece(){
        return $this->belongsTo(Piece::class,'piece_id');
    }

    public function order(){
        return $this->belongsTo(order::class,'order_id');
    }
}
