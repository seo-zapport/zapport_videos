<?php

namespace App;

class Media extends Model
{
    public function categories()
    {
    	return $this->belongsToMany(Category::class, 'category_media', 'media_id');
    }

    public function category_medias()
    {
    	return $this->belongsToMany(Category_media::class, 'category_media', 'category_id', 'media_id');
    }
}
