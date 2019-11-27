<?php

namespace App;

class Category extends Model
{
    public function medias()
    {
    	return $this->belongsToMany(Media::class, 'category_media', 'category_id');
    }

    public function category_medias()
    {
    	return $this->belongsToMany(Category_media::class, 'category_media', 'category_id', 'media_id');
    }
}
