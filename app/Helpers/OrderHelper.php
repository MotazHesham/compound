<?php

function getMaintenanceType($type)
{
    if ($type == 1)
        return trans('admins.Regular_maintenance');
    if ($type == 2)
        return trans('admins.Emergency_maintenance');
}

function getStatusAndBtn($status,$type)
{
    foreach (orderStatuses($type) as $row) {
        if ($row['id'] == $status)
            return [$row['class'],$row['name']];
    }
}

/**
 * @param Tenant
 * @return array
 */
function orderStatuses($type)
{
    if($type== 1)
        return [
            ['name' => trans('Tenant.OrderNew'), 'id' => 1,'class'=>'success'],
            ['name' => trans( 'Tenant.OrderSuper'), 'id' => 2,'class'=>'warning'],
            ['name' => trans('Tenant.OrderTech'), 'id' => 3,'class'=>'secondary'],
            ['name' => trans('Tenant.OrderProgress'), 'id' => 4,'class'=>'info'],
            ['name' => trans('Tenant.OrderDone'), 'id' => 5,'class'=>'success'],
            ['name' => trans('Tenant.OrderCancel'), 'id' => 6,'class'=>'danger'],
        ];
}

/**
 * @return string
 */
function getChangeStatusTitle(){
    return  'assign to technical';
}


function getOrdersCount(){
    if(adminInfo()->roleType ==1)
        return \App\Models\order::count();
    if(adminInfo()->roleType ==2)
        return \App\Models\order::where('super_id',adminInfo()->id)->count();
    if(adminInfo()->roleType ==3)
        return \App\Models\order::where('technical_id',adminInfo()->id)->count();
}

/**
 * @param $limit
 * @return mixed
 */
function getOrders($limit){
    if(adminInfo()->roleType ==1)
        return \App\Models\order::take($limit)->get();
    if(adminInfo()->roleType ==2)
        return \App\Models\order::where('super_id',adminInfo()->id)->take($limit)->get();
    if(adminInfo()->roleType ==3)
        return \App\Models\order::where('technical_id',adminInfo()->id)->take($limit)->get();

}