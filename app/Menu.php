<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = [
        'title',
    ];

    public $timestamps = false;

    protected $fillable = array('parent_id','url','order');

    public function parent()
    {
        return $this->belongsTo('App\Menu', 'parent_id');
    }

	public function children()
    {
        return $this->hasMany('App\Menu', 'parent_id');
    }
}
