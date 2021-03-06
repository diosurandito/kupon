<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Voucher extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $table = 'vouchers';
	protected $dates =['deleted_at'];
}
