<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\ColorProduct;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if (isset($data['preview_image'])) {
            Storage::disk('public')->delete('/images/preview-images', $product->preview_image);             
            $data['preview_image'] = Storage::disk('public')->put('/images/preview-images', $data['preview_image']);
        }

        $productImages = isset($data['product_images']) ? $data['product_images'] : []; 
        $tagsIds = isset($data['tags']) ? $data['tags'] : [];
        $colorsIds = isset($data['colors']) ? $data['colors'] : [];
        unset($data['tags'], $data['colors'], $data['product_images']);

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
       
        foreach ($product->productImages as $productImage) {

            Storage::disk('public')->delete('/images/product-images', $productImage->file_path); 
            $productImage->delete();           
        }        
        foreach ($productImages as $productImage) {
            $currentImages = ProductImage::where('product_id', $product->id)->get();

            if(count($currentImages) > 3) continue;
            $filePath = Storage::disk('public')->put('/images/product-images', $productImage);
            ProductImage::create([
                'product_id' => $product->id,
                'file_path' => $filePath,
            ]);          
        }        


        return view('product.show', compact('product'));
    }
}
