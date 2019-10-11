<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product_id' =>$this->id,
            'product_title' =>$this->title,
            'product_description' => $this->description,
            'product_price' =>$this->price,
//            'product_unit' =>$this->hasUnit,
            'product_unit' =>new UnitResourece($this->hasUnit),
            'product_total' =>$this->total,
            'product_discount' =>$this->discount,
            'product_category' => new CategoryResource($this->category),
            'product_tags' => TagResource::collection($this->tags),
            'product_images' => imageResource::collection($this->images),
            'product_reviews' => ReviewResource::collection($this->reviews),
            'product_options' => $this->jsonOptions(),
        ];
    }
}
