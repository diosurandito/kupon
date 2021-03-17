<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\TransactionDetail;
use App\Transaction;
use App\Customer;
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
                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.id_transaksi')
                ->join('vouchers', 'transaction_details.kode_voucher', '=', 'vouchers.kode_voucher')
				->select('transactions.*', DB::raw('SUM(vouchers.nilai) as ttl_voucher'), DB::raw('group_concat(vouchers.kode_voucher) as kode_voucher_gb'), 'customers.nama', 'customers.no_telp')
				->groupBy('transactions.id')
                ->orderBy('transactions.id', 'DESC')->get();
	
			}

			$data->map(function ($data) {
                
                
                $data->tgl_transaksi_fh = date('d-m-Y', strtotime($data->tgl_transaksi));
                $data->ttl_transaksi_fh = 'Rp. '.format_uang($data->ttl_transaksi);
                $data->ttl_voucher = 'Rp. '.format_uang($data->ttl_voucher);
				$data->kode_voucher_gb_ex = explode(',',$data->kode_voucher_gb);
				$data->kode_voucher_gb = join(' + ',$data->kode_voucher_gb_ex);

				return $data;
			});
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('aksi', function($data){
				$button = '<div class="btn-group">
				<button type="button" class="detail_transaction btn btn-sm btn-info" data-toggle="modal" data-target="#detail_modal_transaction" name="detail_data_transaction" id="'.$data->id.'" nama="'.$data->nama.'" no_telp="'.$data->no_telp.'" ttl_transaksi="'.$data->ttl_transaksi_fh.'" ttl_voucher="'.$data->ttl_voucher.'" tgl_transaksi="'.$data->tgl_transaksi_fh.'" keterangan="'.$data->keterangan.'" ="'.$data->tgl_transaksi_fh.'" title="Detail transaksi">
				<i class="far fa-list-alt"></i>
				</button>
				</div>';
				return $button;
			})
			->rawColumns(['aksi'])
			->make(true);
		}
		$vouchers = Voucher::select('*')
			->where('vc_flag', '=', 1)
			->orderBy('id','ASC')
			->get();

        return view('pages.admin.transaction', compact('vouchers'));
		// dd($data);
    
    }

	public function store(Request $request)
	{
		$ttl_transaksi_str = preg_replace("/[^0-9]/", "", $request->ttl_transaksi);
		$ttl_transaksi_int = (int) $ttl_transaksi_str;
		
		//user insert
		$cust_data = array(
			'nama' => $request->nama,
			'no_telp' => $request->no_telp,
		);
		$cust = Customer::create($cust_data);

		//transaction insert
		$trans_data = array(
			'id_user' => $cust->id,
			'tgl_transaksi' => now(),
			'ttl_transaksi' => $ttl_transaksi_int,
			'keterangan' => $request->keterangan,
		);
		$trans = Transaction::create($trans_data);


		// detail transaction insert
		foreach ($request->kode_voucher as $voucher) {
			$detail_data = array(
				'id_transaksi' => $trans->id,
				'kode_voucher' => $voucher,
			);
			$detail = TransactionDetail::create($detail_data);
			Voucher::where('kode_voucher', '=', $voucher)->update(['vc_flag' => 1]);
			// echo $voucher;
		}

		return redirect()->route('transaction.index')->with('success', 'Data transaksi berhasil ditambahkan');
	}

	public function detail($id)
	{
		if(request()->ajax())
		{
			$data = DB::table('transaction_details')
			->select('kode_voucher')
			->where('id_transaksi', '=', $id)->get();
			return response()->json(['result' => $data]);
		}
	}
}
