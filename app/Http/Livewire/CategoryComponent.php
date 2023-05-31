<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class CategoryComponent extends Component
{
    public string $new_category;

    public $description;

    public string $parentCategory = "";

    public bool $created = false;

    public function create()
    {
        $new_category = new Category();
        $new_category->category_name = $this->new_category;
        $new_category->description = $this->description;
        $new_category->parent_category = ($this->parentCategory == "") ? null : $this->parentCategory;
        $new_category->save();
        $this->created = true;
    }

    public function render()
    {
        return view('livewire.category-component', ['categories' => Category::all()])->extends("layouts.app");
    }
}
