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

    public int $edit;

    public array $edited = [
        "name" => "",
        "description" => ""
    ];

    public function create()
    {
        $new_category = new Category();
        $new_category->category_name = $this->new_category;
        $new_category->description = $this->description;
        $new_category->parent_category = ($this->parentCategory == "") ? null : $this->parentCategory;
        if ($this->parentCategory != "") {
            $category = Category::where('category_name', $this->parentCategory)->first();
            $category->sub_count++;
            $category->save();
        }
        $new_category->save();
        $this->created = true;
    }

    public function delete(int $id)
    {
        Category::find($id)->delete();
    }

    public function changeEditCategory($id)
    {
        $this->edit = $id;
    }

    public function update(int $id)
    {
        $category = Category::find($id);
        $category->category_name = $this->edited["name"];
        $category->description = $this->edited["description"];
        $category->save();
        $this->edit = !$this->edit;
    }//TODO VALIDATION

    public function render()
    {
        return view('livewire.category-component', ['categories' => Category::all()])->extends("layouts.app");
    }
}
