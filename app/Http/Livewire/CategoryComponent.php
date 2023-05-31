<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{
    public string $new_category;

    public function fillTheLove()
    {
        $new_category = new Category();
    }

    public function render()
    {
        return view('livewire.category-component')->extends("layouts.app");
    }
}
