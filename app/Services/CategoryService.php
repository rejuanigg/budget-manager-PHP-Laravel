<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function store (array $data, int $userId): Category
    {
        $data['user_id'] = $userId;
        return Category::create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function destroy(Category $category): void
    {
        $category->delete();
    }
}

?>
