<?php
/**
 * @return mixed
 */
function TenantData(){
    return  Auth::guard('Tenant')->user();
}

/**
 * @return string
 */
function getTenantImage()
{
    return get_baseUrl() . '/images/helpers/rent.jpg';
}

function getParty(){
    $data= \App\Models\Party::with('bus')->orderBy('id','desc')->get();
    foreach($data as $row){
        $row['class']=getClass($row->id);
    }
    return $data;
}


function getClass($id){
    $book=\App\Models\PartyBooking::where('party_id',$id)->where('tenant_id',TenantData()->id)->first();
    if(!is_null($book)){
        return 'bg-info ';
    }else{
        $Party=\App\Models\Party::find($id);
       return $Party->date > now() ? 'be-success' : 'bg-danger';
    }
}
