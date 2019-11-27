<?php

namespace App;

class Category_media extends Model
{
    public function categories()
    {
    	return $this->belongsToMany(Category::class, 'category_media', 'category_id', 'media_id');
    }

    public function medias()
    {
    	return $this->belongsToMany(Media::class, 'category_media', 'category_id', 'media_id');
    }
}
