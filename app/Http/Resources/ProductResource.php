<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'provider_id' => $this->provider_id,
            'type_id' => $this->type_id,
            'name' => $this->name,
            'code' => $this->code,
            'price' => $this->price,
            'productiontime' => $this->productiontime,
            'productionperiod' => $this->productionperiod,

        ];
    }
}
