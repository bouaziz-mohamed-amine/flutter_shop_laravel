<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProductsResource extends JsonResource
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
            "id"=> $this->id,
            "title"=> $this->title,
            //"products"=> ProductResource::collection($this->whenLoaded('products'))
            "products"=> ProductResource::collection($this->products)
        ];
    }
}
