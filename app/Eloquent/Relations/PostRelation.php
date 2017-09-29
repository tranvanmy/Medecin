<?php
namespace App\Eloquent\Relations;

use App\Eloquent\Category;

trait PostRelation
{
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
