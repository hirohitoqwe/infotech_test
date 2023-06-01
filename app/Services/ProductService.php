<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\RelantionProdCat;

class ProductService
{
    public function createProduct(array $new_product, array $categories): void
    {
        $product = new Product();
        $product->product_name = $new_product["product_name"];
        $product->price = $new_product["product_price"];
        $product->save();
        foreach ($categories as $key => $category) {
            $model = Category::where('category_name', $category)->first();
            $model->product_count += 1;
            $model->save();
            $rel = new RelantionProdCat();
            $rel->product_id = $product->id;
            $rel->category_id = $model->id;
            $rel->save();
        }
        $this->created = true;
    }
}
