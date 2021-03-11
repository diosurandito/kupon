@extends('templates.admin.default')

@section('content')


<main id="main-container">

	<!-- Hero -->
	<div class="bg-body-dark">
		<div class="content content-full">
			<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
				<h1 class="flex-sm-fill h3 my-2">
					Data Transaksi
				</h1>
				<nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-alt">
						<li class="breadcrumb-item">Admin</li>
						<li class="breadcrumb-item" aria-current="page">
							<a class="link-fx" href="">Data Transaksi</a>
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
				<h2 class="block-title text-white">Data Transaksi</h2>
				<button class="btn mr-1 mb-0" style="background-color: #ff8e0d;border-color: #ffffff;color:#2d174c;" name="add_transaction_btn" id="add_transaction_btn" data-toggle="modal" data-target="#add_transaction_modal">
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
					
				</div>
				<!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
				<table id="tb_transaction" class="table table-sm table-bordered table-striped" style="font-size: 14px;width:100%;">
					<thead class="thead-dark text-center">
						<tr>
							<th width="20" style="font-size: 14px;" class="align-middle">No.</th>
							<th style="font-size: 14px;" class="align-middle">Nama</th>
							<th style="font-size: 14px;" class="align-middle">No Telp</th>
							<th style="font-size: 14px;" class="align-middle">Total Transaksi</th>
							<th style="font-size: 14px;" class="align-middle">Total Nilai transaction</th>
							<th style="font-size: 14px;" class="align-middle">Tanggal Transaksi</th>
							<th width="100" style="font-size: 14px;" class="align-middle">Aksi</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>  
			</div>
		</div>
	</div>

	<!-- detail -->
	<div class="modal fade" id="detail_modal_transaction" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header" style="background-color: #7750b1;">
						<h3 class="block-title">Detail Data Transaksi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="fa fa-fw fa-times"></i>
							</button>
						</div>
					</div>
					<div class="block-content font-size-sm">
						<div class="row">
							<div class="col-lg-8 col-xl-12">
								<form method="post" id="detail_transaction_form">
									@csrf
									<div class="row">
										<div class="form-group col-6">
											<label for="">Kode transaction</label><br>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text text-white" style="background-color: #7750b1;"><i class="fa fa-barcode"></i>
													</span>
												</div>
												<input type="text" class="form-control" id="kode_transaction_detail" name="kode_transaction_detail" maxlength="15" placeholder="Masukkan kode transaction" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>
											</div>
										</div>
										<div class="form-group col-6">
											<label for="">Nilai transaction</label><br>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text text-white" style="background-color: #7750b1;"><i class="fa fa-money-check-alt"></i>
													</span>
												</div>
												<input type="text" class="form-control" maxlength="17" id="nilai_detail" name="nilai_detail" placeholder="Masukkan nilai transaction" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>   
											</div>
										</div>
									</div>
									
									<div class="block-content block-content-full text-right border-top">
										<input type="hidden" name="hidden_id_transaction" id="hidden_id_transaction">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										<!-- <button type="submit" class="btn" style="background-color: #ff8e0d;border-color:#000000;" id="detail_transaction_savebtn">Simpan</button> -->
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</main>
@endsection