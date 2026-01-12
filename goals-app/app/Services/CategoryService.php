<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Get all categories ordered by name.
     */
    public function all(): Collection
    {
        return Category::orderBy('name', 'asc')->get();
    }
}