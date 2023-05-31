<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductComponent extends Component
{

    public string $product_name;
    public int $product_price;

    public bool $created = false;

    public function create()
    {
        $product = new Product();
        $product->product_name = $this->product_name;
        $product->price = $this->product_price;
        $product->save();
        $this->created = true;
    }//TODO VALIDATION AND CATEGORIES SELECT

    public function render()
    {
        return view('livewire.product-component')->extends("layouts.app");
    }
}
