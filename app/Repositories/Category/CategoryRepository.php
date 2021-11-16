<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function getModel()
    {
        return Category::class;
    }
}