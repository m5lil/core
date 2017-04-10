<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    public $table = "post_translations";
    public $timestamps = false;
    protected $fillable = [
        'title', 'body', 'seo_title', 'seo_keywords', 'seo_description',
    ];
}
