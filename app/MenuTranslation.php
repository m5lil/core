<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    public $table = "menu_translations";
    public $timestamps = false;
    protected $fillable = [
        'title',
    ];
}
