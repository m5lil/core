<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = [
        'title',
    ];

    protected $fillable = [
        'status',
        'slug',
    ];

     public function posts()
     {
         return $this->hasMany('App\Post');
     }
	// use SluggableTrait;
    // protected $sluggable = [
    //     'build_from' => 'name',
    //     'save_to'    => 'slug',
    // ];





}
