<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $translatedAttributes = [
        'title', 'body', 'seo_title', 'seo_keywords', 'seo_description',
    ];

    protected $fillable = [
        'user_id', 'statue', 'category_id',
//        'photo',
    ];

    protected $casts = [
        'photo' => 'array',
    ];

     public function comments()
	 {
	     return $this->hasMany('App\Comments','post_id');
	 }

     public function user()
	 {
	 	return $this->belongsTo('App\User','user_id');
	 }
     public function category()
	 {
	 	return $this->belongsTo('App\Category','category_id');
	 }



}
