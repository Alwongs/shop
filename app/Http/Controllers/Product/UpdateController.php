<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\ColorProduct;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        // dd($data);

        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

        $tagsIds = isset($data['tags']) ? $data['tags'] : [];
        $colorsIds = isset($data['colors']) ? $data['colors'] : [];
        unset($data['tags'], $data['colors']);

        // $product = Product::firstOrCreate([
        //     'title' => $data['title']
        // ], $data);
        $product->update($data);

        foreach ($product->tags as $tag) {
            $productTag = ProductTag::where('tag_id', $tag->id)->where('product_id', $product->id);
            $productTag->delete();
        }
        foreach ($tagsIds as $tagsId) {
            ProductTag::firstOrCreate([
                'product_id' => $product->id,
                'tag_id' => $tagsId
            ]);
        }        

        foreach ($product->colors as $color) {
            $colorProduct = ColorProduct::where('color_id', $color->id)->where('product_id', $product->id);
            $colorProduct->delete();
        }
        foreach ($colorsIds as $colorsId) {
            ColorProduct::firstOrCreate([
                'product_id' => $product->id,
                'color_id' => $colorsId
            ]);
        }        

        return view('product.show', compact('product'));
    }
}
