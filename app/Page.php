<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = [
        'title', 'body', 'seo_title', 'seo_keywords', 'seo_description',
    ];

    protected $fillable = ['statue',
        'slug','photo'
    ];

}
