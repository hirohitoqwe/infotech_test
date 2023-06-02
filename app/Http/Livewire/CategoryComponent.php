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

    public $property;

    public Collection $categories;

    public int $edit = 0;

    public function create(CategoryService $service)
    {
        $validated = $this->validate([
            "new_category.category_name" => "required|min:4|string",
            "new_category.description" => "required|min:10|string",
            "new_category.parent_category" => "nullable",
        ])["new_category"];
        try {
            $this->new_category = $service->createCategory($validated);
            $this->categories = Category::all();
            $this->created = true;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent("alert", [
                "type" => "error",
                "message" => "Что-то пошло не так во время создания новой категории"
            ]);
        }
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

    public function update(int $id, CategoryService $service)
    {
        $validated = $this->validate(["edited.name" => "required|min:4|string",
            "edited.description" => "required|min:10|string",
            "edited.parent_category" => ""])["edited"];
        try {
            $service->updateCategory($id, $validated);
            $this->edit = 0;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent("alert", [
                "type" => "error",
                "message" => "Что-то пошло не так во время обновления"
            ]);
        }
    }

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.category-component')->extends("layouts.app");
    }
}
