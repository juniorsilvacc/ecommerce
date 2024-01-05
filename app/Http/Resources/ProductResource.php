<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $priceFormated = 'R$ '.number_format($this->price, 2);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $priceFormated,
            'image' => $this->image ? $this->image : null,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
