<?php

namespace App\Http\Resources\Technical;

use App\Models\order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $villa_number = $this->tenant->villa->villa_number ?? '';
        $compound_address = $this->tenant->villa->compound->compound_address ?? '';


        return [
            'id' => $this->id,
            'description' => $this->content,
            'service_type' => $this->type ? Order::SERVICE_TYPE_SELECT[$this->type] : '', 
            'time' => $this->time ? Order::TIMES_SELECT[$this->time] : '',
            'date' => $this->suggestDate,
            'status_code' => $this->status ?? '',
            'status' => $this->status ? Order::STATUS_SELECT[$this->status] : '',
            'service' => $this->cat ? $this->cat->name : '', 
            'address' => $villa_number . ', ' . $compound_address,
            'phone' => $this->tenant->phone ?? '',
            'parts' => ExchangeOrdersResource::collection($this->exchangeOrders)
        ];
    }
}
