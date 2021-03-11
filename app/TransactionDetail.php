<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TransactionDetail extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $table = 'transaction_details';
	protected $dates =['deleted_at'];
}
