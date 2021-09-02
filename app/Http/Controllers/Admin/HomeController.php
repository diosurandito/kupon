<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function index()
    {
      $today = Carbon::now()->format('Y-m-d');
      $vouchers = Voucher::select('*')
      ->whereNull('deleted_at')
      ->where('vc_flag', '=', 0)
      ->where('expired_at', '>=', $today)
      ->orderBy('id','ASC')
      ->get();

      return view('pages.admin.home', compact('vouchers'));
    }
}
