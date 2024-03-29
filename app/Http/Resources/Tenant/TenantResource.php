<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_number' => $this->id_number,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'villa' => $this->villa ? $this->villa->villa_number : '',
        ];
    }
}
