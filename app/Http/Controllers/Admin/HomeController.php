<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;

class HomeController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $vouchers = Voucher::select('*')
			->whereNull('deleted_at')
			->where('vc_flag', '=', 0)
			->orderBy('id','ASC')
			->get();

        return view('pages.admin.home', compact('vouchers'));
    }
}
