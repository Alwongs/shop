<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(Product $product)
    {
        Storage::disk('public')->delete('/images/preview-images', $product->preview_image);

        if ($product->productImages) {
            foreach ($product->productImages as $productImage) {
                Storage::disk('public')->delete('/images/product-images', $productImage->file_path);
            }
        }

        $product->delete();

        return redirect()->route('product.index');
    }
}
