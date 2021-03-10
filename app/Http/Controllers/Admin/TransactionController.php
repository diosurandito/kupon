<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\DetailTransaction;
use App\Transaction;
use App\Voucher;
use DataTables;
use Validator;
use Auth;
use DB;

class TransactionController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
	}

    public function index(Request $request)
    {
        if($request->ajax())
		{
			if(!empty($request->from_date))
			{
				$from_date = date('Y-m-d', strtotime($request->from_date));
				$to_date = date('Y-m-d', strtotime($request->to_date));
				$data = DB::table('transactions')
                ->join('customers', 'transactions.id_user', '=', 'customers.id')
                // ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.id_transaksi')
                ->select('transactions.*', 'customers.nama', 'customers.no_telp')
                ->whereBetween('tgl_transaksi', array($from_date, $to_date))
                ->orderBy('id', 'DESC')->get();
			}else {
				$data = DB::table('transactions')
                ->join('customers', 'transactions.id_user', '=', 'customers.id')
                // ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.id_transaksi')
                ->select('transactions.*', 'customers.nama', 'customers.no_telp')
                ->orderBy('id', 'DESC')->get();
			}

			$data->map(function ($data) {
                
                $data->created_at_fh = date('d-m-Y', strtotime($data->created_at));
                $data->tgl_transaksi_fh = date('d-m-Y', strtotime($data->tgl_transaksi));
                $data->ttl_transaksi_fh = 'Rp. '.format_uang($data->ttl_transaksi);
                $data->ttl_voucher = 'Rp. '.format_uang(300000);
				return $data;
			});

			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('aksi', function($data){
				$button = '<div class="btn-group">
				<button type="button" class="detail_voucher btn btn-sm btn-info" data-toggle="modal" data-target="#detail_modal_voucher" name="detail_data_voucher" id="'.$data->id.'" created_at="'.$data->created_at_fh.'" title="Detail transaksi">
				<i class="fa fa-pen"></i>
				</button>
				</div>';
				return $button;
			})
			->rawColumns(['aksi'])
			->make(true);
		}

        return view('pages.admin.transaction');
    
    }
}
