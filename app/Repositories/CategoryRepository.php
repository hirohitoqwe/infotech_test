<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements RepositoryInterface
{

    public function all(): Collection
    {
        return Category::all();
    }

    public function getById()
    {
        // TODO: Implement getById() method.
    }
}
