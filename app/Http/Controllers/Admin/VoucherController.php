<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VoucherImport;
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
				$from_date = date('Y-m-d 00:00:00', strtotime($request->from_date));
				$to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));
				$data = Voucher::select('*')->whereBetween('created_at', array($from_date, $to_date))->orderBy('id', 'DESC')->orderBy('vc_flag', 'ASC')->get();
			}else {
				$data = Voucher::select('*')->orderBy('id', 'DESC')->orderBy('vc_flag', 'ASC')->get();
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
				<button type="button" class="edit_voucher btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_modal_voucher" name="edit_data_voucher" id="'.$data->id.'" kode_voucher="'.$data->kode_voucher.'" nilai_fh="'.$data->nilai_fh.'" created_at="'.$data->created_at_fh.'" title="Edit Data">
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

	public function store(Request $request)
	{
		$nilai_str = preg_replace("/[^0-9]/", "", $request->nilai);
		$nilai_int = (int) $nilai_str;
		
		$form_data = array(
			'kode_voucher' => $request->kode_voucher,
			'nilai' => $nilai_int,
		);

		Voucher::create($form_data);

		return response()->json(['success' => 'Data Voucher Berhasil Ditambahkan.']);
	}

	public function edit($id)
	{
		if(request()->ajax())
		{
			$data = Voucher::findOrFail($id);
			return response()->json(['result' => $data]);
		}
	}

	public function update(Request $request)
	{
		$rules = array(
			'kode_voucher_edit'        =>  'required',
			'nilai_edit'        =>  'required',
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
			return response()->json(['errors' => $error->errors()->all()]);
		}
		$nilai_edit_str = preg_replace("/[^0-9]/", "", $request->nilai_edit);
		$nilai_edit_int = (int) $nilai_edit_str;

		$form_data = array(
			'kode_voucher'    =>  $request->kode_voucher_edit,
			'nilai'    =>  $nilai_edit_int,
		);

		Voucher::whereId($request->hidden_id_voucher)->update($form_data);

		return response()->json(['success_edit' => 'Data Voucher Berhasil Diubah.']);

	}
	
	public function destroy($id)
	{
		$data = Voucher::findOrFail($id);
		$data->delete();

		return response()->json(['success' => 'Data Voucher Berhasil Dihapus.']);
	}

	public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        // membuat nama file unik
        $nama_file = $file->hashName();
        //temporary file
        $path = $file->storeAs('public/excel/',$nama_file);
        // import data
        $import = Excel::import(new VoucherImport(), storage_path('app/public/excel/'.$nama_file));
        //remove from server
        Storage::delete($path);
        if($import) {
            //redirect
            return redirect()->route('voucher.index')->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('voucher.index')->with(['error' => 'Data Gagal Diimport!']);
        }
    }
}
