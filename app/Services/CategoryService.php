<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function createCategory(array $new_category): array
    {
        $n_category = new Category();
        $n_category->category_name = $new_category["category_name"];
        $n_category->description = $new_category["description"];
        $n_category->parent_category = ($new_category["parent_category"] == "") ? null : $new_category["parent_category"];
        if ($new_category["parent_category"] != "") {
            $category = Category::where('category_name', $new_category["parent_category"])->first();
            $category->sub_count++;
            $category->save();
        }
        $n_category->save();
        return [
            "category_name" => "",
            "description" => "",
            "parent_category" => ""
        ];
    }

    public function updateCategory(int $id, array $edited): void
    {
        $category = Category::find($id);
        $edits = Category::where("parent_category", $category->category_name)->get();
        foreach ($edits as $edit) {
            $edit->parent_category = $edited["name"];
            $edit->save();
        }
        $category->category_name = $edited["name"];
        $category->description = $edited["description"];
        $category->save();
    }
}
