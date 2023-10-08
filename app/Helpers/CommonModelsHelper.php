<?php

/**
 * @param $type
 * @return array|\Illuminate\Contracts\Translation\Translator|string|null
 */
function getSCatTitle($type)
{
    if ($type == 1)
        return trans('admins.Category');
    if ($type == 2)
        return trans('admins.departments');

}

/**
 * @param $type
 * @return mixed
 */
function getCats($type)
{
    return \App\Models\Category::where('type', $type)->get();
}

/**
 * @return array
 */
function getRelations()
{
    return [
        ["name" => trans('admins.father'), "id" => 1],
        ["name" => trans('admins.mother'), "id" => 2],
        ["name" => trans('admins.brother'), "id" => 3],
        ["name" => trans('admins.sister'), "id" => 4],
        ["name" => trans('admins.son'), "id" => 5],
        ["name" => trans('admins.cousin'), "id" => 6],
        ["name" => "wife", "id" => 7],
    ];
}

/**
 * @param $id
 * @return mixed
 */
function getRelationName($id){
    foreach (getRelations() as $row){
        if($id == $row['id'])
            return $row['name'];
    }
}

/**
 * @param $status
 * @return array
 */
function getBookingStatusAndBtn($status){
    foreach (bookingStatuses() as $row) {
        if ($row['id'] == $status)
            return [$row['class'],$row['name']];
    }
}

/**
 * @return array
 */
function bookingStatuses()
{
        return [
            ['name' => trans('Tenant.OrderNew'), 'id' => 1,'class'=>'success'],
            ['name' => trans('Tenant.completed'), 'id' => 2,'class'=>'warning'],
            ['name' =>trans('Tenant.canceled') , 'id' => 3,'class'=>'danger'],
        ];
}