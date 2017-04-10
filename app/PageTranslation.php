<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    public $table = "page_translations";
    public $timestamps = false;
    protected $fillable = [
        'title', 'body', 'seo_title', 'seo_keywords', 'seo_description',
    ];

}
