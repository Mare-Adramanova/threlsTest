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
            'name' => $this->name,
            'price' => $this->price,
            'description'=> $this->description,
            'quantity'=> $this->quantity == 0 ? 'Out of stock' : $this->quantity,
            $this->mergeWhen($this->quantity > 0, [
                'href' => [
                    'addToCart' => route('cart.index',[$this->id, 'quantity' => "1"])
                    
                ]
            ]),
            
            
        ];
    }
}
