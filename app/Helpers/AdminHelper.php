<?php
/**
 * @return string
 */
function getLogo()
{
    return 'https://hasp-sa.com/img/has_logo.png';
}

/**
 * @return mixed
 */
function adminInfo(){
    return Auth::guard('Admin')->user();
}

/**
 * @param $image
 * @return mixed|string
 */
function getAdminImage($image)
{
    if ($image)
        return getImageUrl('Admin', $image);
    return defaultImages(2);
}


function getNameInIndexPage()
{
    return trans('admins.projectName');
}

function getCounts($model)
{
    return $model->count();
}


/**
 * @return array
 */
function getFlagAndName()
{
    $array = ['sa', 'English', 'us', 'en'];
    if (getLang() == 'en')
        $array = ['us', 'عربي', 'sa', 'ar'];
    return $array;
}

/**
 * @param $admin
 * @return array
 */
function adminsRoleArray($admin)
{
    if ($admin->id != 1) {
        $array = [];
        foreach ($admin->roles as $row) {
            $array[] = $row->id;
        }
    } else {
        $array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
    }
    return $array;
}

;

/**
 * @return array
 */
function slidersMainLinks($type)
{
    if ($type == 'basicInformation')
        return [
            [trans('admins.compounds'), route('Compound.index')],
            [trans('admins.Villas'), route('Villas.index')],
            [trans('admins.departments'), route('Category.index', ['type' => 2])],
            [trans('admins.Staff'), route('Admin.index')],
            [trans('admins.tenant'), route('Tenant.index')],
            [trans('admins.Slider'), route('Slider.index')],
        ];

    if ($type == 'Warehouse')
        return [
            [trans('admins.Category'), route('Category.index',['type'=>1])],
            [trans('admins.Warehouse'), route('Piece.index')],
        ];
}

;
/**
 * @return array
 */
function AdminsROlesTypes()
{
    return [
        [1, trans('admins.admin')],
        [2, trans('admins.supervisor')],
        [3, trans('admins.Technical')],
    ];
}

/**
 * @param $roleType
 * @return array|\Illuminate\Contracts\Translation\Translator|string|null
 */
function roleTypeName($roleType)
{
    if ($roleType == 1)
        return trans('admins.admin');
    if ($roleType == 2)
        return trans('admins.supervisor');
    if ($roleType == 3)
        return trans('admins.Technical');
}

/**
 * @param $type
 * @return mixed
 */
function getAdminsByType($type)
{
    return \App\Models\Admin::where('roleType', $type)->get();
}






