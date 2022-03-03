<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
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
            'quantity'=> $this->quantity,
            'href' => [
                'link' => route('product.show',$this->id),
                'delete' => route('product.destroy',$this->id),
                'create' => route('product.create'),
             ]
            
            
        ];
        
    }
}
