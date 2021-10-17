<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get(Request $request)
    {
        return response(Product::all() . "\n");
    }

    public function delete(Request $request, $sku)
    {
        $products = Product::query()->where('sku', $sku)->get();

        if (count($products) === 0) {
            return response("Product $sku not found");
        }

        $products[0]->delete();

        return response("Product $sku deleted");
    }

    public function add(Request $request, $sku, $name)
    {
        $model = new Product();
        $model->setAttribute('sku', $sku);
        $model->setAttribute('name', $name);
        $model->save();

        $id = $model->getAttribute('id');

        return response("Product $sku added with id: $id");
    }
}
