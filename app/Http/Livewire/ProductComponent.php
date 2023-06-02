<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\RelantionProdCat;
use App\Services\ProductService;
use Livewire\Component;

class ProductComponent extends Component
{

    public array $new_product = [
        "product_name" => "",
        "product_price" => 0
    ];

    public array $categories = [];
    public bool $created = false;

    public function create(ProductService $service)
    {
        $service->createProduct($this->new_product, $this->categories);
        $this->created = true;
    }

    public function render()
    {
        return view('livewire.product-component', ['allCategories' => Category::all()])->extends("layouts.app");
    }
}
