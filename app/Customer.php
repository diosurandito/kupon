<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $table = 'customers';
	protected $dates =['deleted_at'];
}
