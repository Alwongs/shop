<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Color\ColorResource;
use App\Models\Product;

class ProductMinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $products = Product::where('group_id', $this->group_id)->get();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'image_url' => $this->imageUrl,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'count' => $this->count,
            'is_published' => $this->title,
            'category' => new CategoryResource($this->category), 
            'colors' => ColorResource::collection($this->colors)            
        ];
    }
}
