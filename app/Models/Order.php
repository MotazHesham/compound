<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected  $table ='orders';

    public const TIMES_SELECT = [
        '08:00'     => '08:00 am', 
        '08:30'     => '08:30 am', 
        '09:00'     => '09:00 am', 
        '09:30'     => '09:30 am', 
        '10:00'     => '10:00 am', 
        '10:30'     => '10:30 am', 
        '11:00'     => '11:00 am', 
        '11:30'     => '11:30 am', 
        '12:00'     => '12:00 pm', 
        '12:30'     => '12:30 pm', 
        '13:00'     => '01:00 pm', 
        '13:30'     => '01:30 pm', 
        '14:00'     => '02:00 pm', 
        '14:30'     => '02:30 pm', 
        '15:00'     => '03:00 pm', 
        '15:30'     => '03:30 pm', 
        '16:00'     => '04:00 pm', 
        '16:30'     => '04:30 pm', 
        '17:00'     => '05:00 pm', 
        '17:30'     => '05:30 pm', 
        '18:00'     => '06:00 pm', 
        '18:30'     => '06:30 pm', 
        '19:00'     => '07:00 pm', 
        '19:30'     => '07:30 pm', 
        '20:00'     => '08:00 pm', 
        '20:30'     => '08:30 pm', 
        '21:00'     => '09:00 pm', 
    ];

    public const STATUS_SELECT = [
        '1' => 'في أنتطار تعيين فني',
        '2' => 'قيد المراجعة',
        '3' => 'تم تعيين فني',
        '4' => 'قيد التنفيذ',
        '5' => 'تم الأكتمال',
        '6' => 'تم التقييم',
    ];
    public const SERVICE_TYPE_SELECT = [
        '1' => 'صيانة دورية',
        '2' => 'صيانة طارئة', 
    ];
    protected $fillable = [
        'tenant_id',
        'cat_id',
        'content',
        'date',
        'suggestDate',
        'time',
        'type',
        'status',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cat(){
        return $this->belongsTo(Category::class,'cat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant(){
        return $this->belongsTo(Tenant::class,'tenant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function super(){
        return $this->belongsTo(Admin::class,'super_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function technical(){
        return $this->belongsTo(Admin::class,'technical_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeOrders(){
        return $this->hasMany(exchangeOrder::class,'order_id');
    }
    public function rate(){
        return $this->hasOne(Rate::class,'order_id');
    }
}
