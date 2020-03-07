<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    protected $table = 'blog_translations';

    protected $fillable = ['name','blog_id', 'description'];
}
