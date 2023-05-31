<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\RelantionProdCat;
use Livewire\Component;

class ProductComponent extends Component
{
    public string $product_name;
    public int $product_price;

    public bool $created = false;

    public array $categories = [];

    public function create()
    {
        $product = new Product();
        $product->product_name = $this->product_name;
        $product->price = $this->product_price;
        $product->save();
        foreach ($this->categories as $key => $category) {
            $rel = new RelantionProdCat();
            $rel->product_id = $product->id;
            $rel->category_id = Category::where('category_name', $category)->first()->id;
            $rel->save();
        }
        $this->created = true;
    }//TODO VALIDATION

    public function render()
    {
        return view('livewire.product-component', ['allCategories' => Category::all()])->extends("layouts.app");
    }
}
