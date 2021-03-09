@extends('templates.admin.default')

@section('content')


<main id="main-container">

	<!-- Hero -->
	<div class="bg-body-dark">
		<div class="content content-full">
			<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
				<h1 class="flex-sm-fill h3 my-2">
					Data Voucher
				</h1>
				<nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-alt">
						<li class="breadcrumb-item">Admin</li>
						<li class="breadcrumb-item" aria-current="page">
							<a class="link-fx" href="">Data Voucher</a>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- END Hero -->

	<!-- Page Content -->

	<div class="content">
		
		<div id="alert"></div>
		@if($message = Session::get('success'))
			<div class="alert alert-success" role="alert">
				{{ $message }}
			</div>
		@elseif($message =  Session::get('error'))
			<div class="alert alert-danger" role="alert">
				{{ $message }}
			</div>
		@endif
		<div class="block">
			<div class="block-header" style="background: #2d174c;">
				<h2 class="block-title text-white">Data Voucher</h2>
				<button class="btn mr-1 mb-0" style="background-color: #ff8e0d;border-color: #ffffff;color:#2d174c;" name="add_voucher_btn" id="add_voucher_btn" data-toggle="modal" data-target="#add_voucher_modal">
					<i class="fa fa-fw fa-plus mr-1"></i> Tambah Data
				</button>
			</div>
			<div class="block-content block-content-full">
			<div class="row mb-2" style="width: 100%;">
					<div class="col-8">
						<form method="post" action="#">
							@csrf
							@method('POST')
							<div class="row mb-2 mt-0" style="margin-bottom: 5px;">

								<div class="col-lg-3">
									<input type="text" class="js-datepicker form-control" name="from_date" id="from_date" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Tanggal Awal" autocomplete="off" required>
								</div>
								<div class="col-xs-1 mt-2 text-center align-middle">
									s/d
								</div>
								<div class="col-lg-3">
									<input type="text" class="js-datepicker form-control" name="to_date" id="to_date" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Tanggal Akhir" autocomplete="off" required>
								</div>
								<div class="col-4">
									<button type="button" name="filter" id="filter" class="btn btn-warning" title="Filter/Search"><i class="fa fa-search"></i></button>
									<button type="button" name="refresh" id="refresh" title="Refresh" class="btn btn-secondary"><i class="fa fa-redo"></i></button>
									<!-- <button type="submit" name="export" id="export" class="btn btn-outline-success" title="Export to Excel"><i class="fa fa-file-excel"></i> Export</i></button> -->
									
								</div>
								<div class="col-lg-3"></div>
							</div>
						</form>
					</div>
					
					<div class="col-4" style="text-align: right;padding-right: 0px">
						<button class="btn btn-success mb-0" name="import_voucher_btn" id="import_voucher_btn" data-toggle="modal" data-target="#import_modal_voucher">
							<i class="fa fa-file-excel"></i> Import
						</button>
					</div>
				</div>
				<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
				<table id="tb_voucher" class="table table-sm table-bordered table-striped" style="font-size: 15px;width:100%;">
					<thead class="thead-dark text-center">
						<tr>
							<th width="20" style="font-size: 15px;" class="align-middle">No.</th>
							<th style="font-size: 15px;" class="align-middle">Kode Tiket</th>
							<th style="font-size: 15px;" class="align-middle">Nilai</th>
							<th style="font-size: 15px;" class="align-middle">Status</th>
							<th width="100" style="font-size: 15px;" class="align-middle">Aksi</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>  
			</div>
		</div>
	</div>
	<!-- tambah data -->
	<div class="modal fade" id="add_voucher_modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header" style="background: #7750b1;">
						<h3 class="block-title">Tambah Data Voucher</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="fa fa-fw fa-times"></i>
							</button>
						</div>
					</div>
					<div class="block-content font-size-sm">
						<div class="row">
							<div class="col-lg-8 col-xl-12">
								<form method="post" id="add_voucher_form">
									@csrf
									<div class="row">
										<div class="form-group col-6">
											<label for="">Kode Voucher</label><br>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text text-white" style="background-color: #7750b1;"><i class="fa fa-barcode"></i>
													</span>
												</div>
												<input type="text" class="js-maxlength form-control" id="kode_voucher" name="kode_voucher" maxlength="15" placeholder="Masukkan kode voucher" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>
											</div>
										</div>
										<div class="form-group col-6">
											<label for="">Nilai Voucher</label><br>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text text-white" style="background-color: #7750b1;"><i class="fa fa-money-check-alt"></i>
													</span>
												</div>
												<input type="text" class="js-maxlength form-control" maxlength="17" id="rupiah" name="nilai" placeholder="Masukkan nilai voucher" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>   
											</div>
										</div>
									</div>
									<div class="block-content block-content-full text-right border-top">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										<button type="submit" class="btn" style="background-color: #ff8e0d;border-color:#000000;" id="add_voucher_savebtn">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- delete -->
	<div class="modal fade" id="confirm_delete_modal_voucher" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin modal-block-vcenter" aria-hidden="true">
		<div class="modal-dialog modal-dialog-popin modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header" style="background-color: #7750b1;">
						<h3 class="block-title">Hapus Data Voucher</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="fa fa-fw fa-times"></i>
							</button>
						</div>
					</div>
					<div class="block-content font-size-sm">
						<p id="delete_message_voucher" style="font-size: 20px;"></p>
					</div>
					<div class="block-content block-content-full text-right border-top">
						<button type="button" class="btn" style="background-color: #ff8e0d;border-color:#000000;" data-dismiss="modal">Batal</button>
						<button type="button" class="btn btn-danger text-white" name="confirm_delete_voucher_btn" id="confirm_delete_voucher_btn">Hapus</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- edit -->
	<div class="modal fade" id="edit_modal_voucher" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header" style="background-color: #7750b1;">
						<h3 class="block-title">Ubah Data Voucher</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="fa fa-fw fa-times"></i>
							</button>
						</div>
					</div>
					<div class="block-content font-size-sm">
						<div class="row">
							<div class="col-lg-8 col-xl-12">
								<form method="post" id="edit_voucher_form">
									@csrf
									<div class="row">
										<div class="form-group col-6">
											<label for="">Kode Voucher</label><br>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text text-white" style="background-color: #7750b1;"><i class="fa fa-barcode"></i>
													</span>
												</div>
												<input type="text" class="js-maxlength form-control" id="kode_voucher_edit" name="kode_voucher_edit" maxlength="15" placeholder="Masukkan kode voucher" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>
											</div>
										</div>
										<div class="form-group col-6">
											<label for="">Nilai Voucher</label><br>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text text-white" style="background-color: #7750b1;"><i class="fa fa-money-check-alt"></i>
													</span>
												</div>
												<input type="text" class="js-maxlength form-control" maxlength="17" id="nilai_edit" name="nilai_edit" placeholder="Masukkan nilai voucher" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>   
											</div>
										</div>
									</div>
									
									<div class="block-content block-content-full text-right border-top">
										<input type="hidden" name="hidden_id_voucher" id="hidden_id_voucher">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										<button type="submit" class="btn" style="background-color: #ff8e0d;border-color:#000000;" id="edit_voucher_savebtn">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- import -->
	<div class="modal fade" id="import_modal_voucher" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header" style="background-color: #7750b1;">
						<h3 class="block-title">Import Data Voucher</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="fa fa-fw fa-times"></i>
							</button>
						</div>
					</div>
					<form action="{{ route('voucher.import') }}" method="POST" enctype="multipart/form-data">
					@csrf
						<div class="block-content font-size-sm text-center">
							<div class="form-group">
								<h5 class="mb-1"><b>Contoh File Excel</b></h5>
								<img class="img-responsive mb-2" src="{{ asset('images/example/contoh_import.png') }}" alt="contoh import" style="max-height:350px;position:relative;">
								<input type="file" name="file" class="form-control" accept=".csv, .xls, .xlsx" required>
							</div>
						</div>
						<div class="block-content block-content-full text-right border-top">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn" style="background-color: #ff8e0d;border-color:#000000;" id="import_submit_btn">Import</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


</main>
@endsection