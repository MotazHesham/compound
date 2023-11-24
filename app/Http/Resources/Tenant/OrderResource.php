<?php

namespace App\Http\Resources\Tenant;

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
        return [
            'id' => $this->id,
            'text' => $this->content,
            'service_type' => $this->type ? Order::SERVICE_TYPE_SELECT[$this->type] : '',
            'technical' => $this->technical ? $this->technical->name : '',
            'technical_id' => $this->technical_id ?? '',
            'time' => $this->time ? Order::TIMES_SELECT[$this->time] : '',
            'date' => $this->suggestDate,
            'status' => $this->status ? Order::STATUS_SELECT[$this->status] : '',
            'service' => $this->cat ? $this->cat->name : '',
            'rate' => $this->rate ? new RateResource($this->rate) : '',
            'parts' => ExchangeOrdersResource::collection($this->exchangeOrders)
        ];
    }
}
