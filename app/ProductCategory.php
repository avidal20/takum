<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = "md_products_categories";

    protected $fillable = [
    	'id',
    	'name_en',
    	'name_fr',
    	'description_en',
    	'description_fr',
    	'state',
    ];

    public function products()
    {
        return $this->hasMany('App\Product','id_category');
    }
}
