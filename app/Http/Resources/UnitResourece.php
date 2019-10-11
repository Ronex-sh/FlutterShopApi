<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResourece extends JsonResource
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
            'unit_id' => $this->unit_id,
            'unit_name' => $this->unit_name,
            'unit_code' =>$this->unit_code,

        ];
    }
}
