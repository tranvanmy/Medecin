<?php
namespace App\Eloquent\Relations;

use App\Eloquent\Category;
use App\Eloquent\Post;

trait CategoryRelation
{
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parentCategories()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
