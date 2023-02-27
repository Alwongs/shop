<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Color;
use App\Models\Category;

class EditController extends Controller
{
    public function __invoke(Product $product)
    {

        $tags = Tag::all();
        $colors = Color::all();
        $categories = Category::all();

        $productTagIds = [];
        $productColorIds = [];
        foreach($product->tags as $productTag) {
            array_push($productTagIds, $productTag->id);
        }
        foreach($product->colors as $productColor) {
            array_push($productColorIds, $productColor->id);
        }

        // dd($product);

        return view('product.edit', compact('product', 'tags', 'colors', 'categories', 'productTagIds', 'productColorIds'));
    }
}
