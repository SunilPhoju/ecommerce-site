<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Rating extends JsonResource
{
    protected $fillable = ['title', 'email', 'description'];
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'rating' => $this->rating
        ];
    }
}
