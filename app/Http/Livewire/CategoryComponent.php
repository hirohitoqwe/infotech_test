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

    public int $edit = 0;

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
        $category = Category::find($id);
        $this->edited["name"] = $category->category_name;
        $this->edited["description"] = $category->description;
        $this->edit = $id;
    }

    public function nullVision()
    {
        $this->edit = 0;
    }

    public function update(int $id)
    {
        $category = Category::find($id);
        $category->category_name = $this->edited["name"];
        $category->description = $this->edited["description"];
        $category->save();
        $this->edit = 0;
    }//TODO VALIDATION

    public function render()
    {
        return view('livewire.category-component', ['categories' => Category::all()])->extends("layouts.app");
    }
}
