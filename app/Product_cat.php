<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_cat extends Model
{
    use SoftDeletes;
	protected $table = "product_categories";
	protected $primarykey ="id";
	protected $fillable = [
        'category_name',
    ];
    //
}
