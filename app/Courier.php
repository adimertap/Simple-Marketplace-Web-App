<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courier extends Model
{
    use SoftDeletes;
    protected $table = "couriers";
	protected $primarykey ="id";
	protected $fillable = [
        'courier',
    ];
}
