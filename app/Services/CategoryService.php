<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function createCategory(array $new_category): array
    {
        Category::create([
            "category_name" => $new_category["category_name"],
            "description" => $new_category["description"],
            "parent_category" => ($new_category["parent_category"] == "") ? null : $new_category["parent_category"],
        ]);
        if ($new_category["parent_category"] != "") {
            $category = Category::where('category_name', $new_category["parent_category"])->first();
            $category->sub_count++;
            $category->save();
        }
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
            $edit->fill([
                "parent_category" => $edited["name"]
            ])->save();
        }
        $category->fill([
            'category_name' => $edited['name'],
            'category_description' => $edited['description']
        ])->save();
    }
}
