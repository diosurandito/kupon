<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Voucher;
use DataTables;
use Validator;
use Auth;
use DB;

class VoucherController extends Controller
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
				$data = Voucher::latest()->whereBetween('created_at', array($from_date, $to_date))->orderBy('vc_flag', 'ASC')->get();
			}else {
				$data = Voucher::latest()->orderBy('vc_flag', 'ASC')->get();
			}

			$data->map(function ($data) {
                
                $data->created_at_fh = date('d-m-Y', strtotime($data->created_at));
                $data->nilai_fh = 'Rp. '.format_uang($data->nilai);
				return $data;
			});

			return DataTables::of($data)
			->addIndexColumn()
            ->addColumn('status', function($data){
                if ($data->vc_flag == 0) {
                    $status = '<button type="button" class="btn btn-sm btn-outline-primary" style="cursor: default;">UNUSED</button>';
                }else{
                    $status = '<button type="button" class="btn btn-sm btn-outline-success" style="cursor: default;">USED</button>';
                }
                return $status;
            })
			->addColumn('aksi', function($data){
				$button = '<div class="btn-group">
				<button type="button" class="edit_voucher btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_modal_voucher" name="edit_data_voucher" id="'.$data->id.'" kode_voucher="'.$data->kode_voucher.'" nilai="'.$data->nilai.'" created_at="'.$data->created_at_fh.'" title="Edit Data">
				<i class="fa fa-pen"></i>
				</button>
				<button type="button" class="delete_voucher btn btn-sm btn-danger" data-toggle="modal" data-target="#confirm_delete_modal_voucher" name="delete_data_voucher" id="'.$data->id.'" kode_voucher="'.$data->kode_voucher.'" title="Hapus Data">
				<i class="fa fa-fw fa-trash"></i>
				</button>
				</div>';
				return $button;
			})
			->rawColumns(['aksi', 'status'])
			->make(true);
		}

        return view('pages.admin.voucher');
    
    }
}
