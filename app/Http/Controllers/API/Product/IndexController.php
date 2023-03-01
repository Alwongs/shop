<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\Product\ProductResource;

class IndexController extends Controller
{
    public function __invoke()
    {
        $product = Product::all();

        return ProductResource::collection($product);
    }
}
