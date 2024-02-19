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
            'technical_id' => $this->technical_id ?? 0,
            'time' => $this->time ? Order::TIMES_SELECT[$this->time] : '',
            'date' => $this->suggestDate,
            'status' => $this->status ? Order::STATUS_SELECT[$this->status] : '',
            'payment_status' => $this->payment_status ? Order::PAYMENT_STATUS_SELECT[$this->payment_status] : '',
            'payment_status_key' => $this->payment_status ?? '',
            'service' => $this->cat ? $this->cat->name : '',
            'rate' => $this->rate ? new RateResource($this->rate) : '',
            'parts' => ExchangeOrdersResource::collection($this->exchangeOrders),
            'invoice' => $this->payment_status == 'request_payment' ? [
                'total' => $this->exchangeOrders()->where('status',1)->where('part_from','warehouse')->sum('price') . ' SAR',
                'data' =>InvoiceExchangeOrdersResource::collection($this->exchangeOrders()->where('status',1)->where('part_from','warehouse')->get())
            ] : null,
        ];
    }
}
