<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\RelantionProdCat;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class CategoryComponent extends Component
{

    public array $new_category = [
        "category_name" => "",
        "description" => "",
        "parent_category" => ""
    ];

    public array $edited = [
        "name" => "",
        "description" => "",
        "parent_category" => ""
    ];

    public bool $created = false;

    public Collection $categories;

    public int $edit = 0;

    public function create(CategoryService $service)
    {
        $this->new_category = $service->createCategory($this->new_category);
        $this->categories = Category::all();
        $this->created = true;
    }

    public function delete(int $id)
    {
        Category::find($id)->delete();
    }

    public function changeEditCategory($id)
    {
        $category = Category::find($id);
        $this->edited["name"] = $category->category_name;
        $this->edited["description"] = $category->description;
        $this->edited["parent_category"] = $category->parent_category;
        $this->edit = $id;
    }

    public function nullVision()
    {
        $this->edit = 0;
    }

    public function update(int $id, CategoryService $service)
    {
        $service->updateCategory($id, $this->edited);
        $this->edit = 0;
    }//TODO VALIDATION

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.category-component')->extends("layouts.app");
    }
}
