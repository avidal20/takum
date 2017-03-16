<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "md_products";

    protected $fillable = [
    	'id',
    	'name_en',
    	'name_fr',
    	'description_en',
    	'description_fr',
    	'state',
      'price',
      'id_category'
    ];

    public function category()
    {
        return $this->belongsTo('App\ProductCategory','id_category');
    }
}
