<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_cat_det extends Model
{
	use SoftDeletes;
    protected $table= "product_category_details";
    protected $primarykey = "id";
    protected $fillable = [
        'product_id','category_id',
    ];
}
