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
</main>
@endsection