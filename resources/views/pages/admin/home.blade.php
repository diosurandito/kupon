@extends('templates.admin.default')

@section('content')
<!-- Main Container -->
<main id="main-container">



    <!-- Hero -->
    <div class="bg-image overflow-hidden" style="background-image: url({{ asset('images/bg/bgsale.jpg') }});">
        <div class="bg-primary-dark-op">
            <div class="content content-narrow content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Dashboard</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Selamat Datang {{ Auth::user()->nama }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">

<div class="block">

    <div class="block">
        <div class="block-header">
            <h3 class="block-header">Formulir Tambah Transaksi Voucher</h3> 
        </div>
        <div class="block-content block-content-full">
            <form class="js-validation" id="add_rekap_po_form" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('POST')

                <!-- Regular -->
                <div class="row items-push">
                    <div class="column col-6">
                        <div class="form-group">
                            <label for="">Nama Customer<span class="text-danger">*</span></label><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="background-color: #7750b1;color:#ffffff;"><i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="js-maxlength form-control" id="nama" name="nama" maxlength="100" placeholder="Masukkan nama customer" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>

                        </div>
                    </div>

                    <div class="row">
                    <div class="form-group col-7">
                        <label for="">No. Telp Customer<span class="text-danger">*</span></label><br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #7750b1;color:#ffffff;"><i class="fa fa-phone"></i>
                                </span>
                            </div>
                            <input type="tel" id="no_telp" class="form-control js-maxlength" pattern="\+?([ -]?\d+)+|\(\d+\)([ -]\d+)" maxlength="25" name="no_telp" placeholder="Misal: 081144449999" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>
                        </div>
                    </div>

                    <div class="form-group col-5">
                        <label for="">Total Transaksi<span class="text-danger">*</span></label><br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"style="background-color: #7750b1;color:#ffffff;"><i class="far fa-money-bill-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="js-maxlength form-control" maxlength="17" id="rupiah" name="ttl_transaksi" placeholder="Masukkan total transaksi" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>   
                        </div>
                    </div>
                    </div>
                    
                    <div class="form-group">
                            <label for="">Keterangan<span class="text-danger">*</span></label><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"style="background-color: #7750b1;color:#ffffff;"><i class="fa fa-list-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="js-maxlength form-control" maxlength="150" id="keterangan" name="keterangan" placeholder="Masukkan keterangan transaksi" data-always-show="true" data-warning-class="badge badge-primary" data-limit-reached-class="badge badge-primary" required>
                            </div>
                        </div>
                    

            </div>

            <div class="column col-6">
                
                    <div class="form-group">
                        <label for="">Kode Voucher<span class="text-danger">*</span></label><br>
                        <div class="input-group">
                            <select class="js-select2 form-control" id="kode_voucher" name="kode_voucher" style="width: 100%;height: 2.375rem;line-height: 2.375rem;background-color: #7750b1;font-size: 1.1rem;" data-placeholder="Pilih kode voucher" multiple required>
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach ($vouchers as $v)
                                <option value="{{$v->kode_voucher}}">{{$v->kode_voucher}} ({{format_ribuan($v->nilai)}})</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    
            </div><br>
            <div class="block-content block-content-full text-right border-top">
                <a href="#" type="submit" class="btn btn-secondary" >Batal</a>
                <button type="submit" class="btn" style="background-color: #ff8e0d;border-color:#000000;">Simpan</button>
            </div>
            <!-- Submit -->

            <!-- END Submit -->
        </form>
    </div>
</div>



</div>


    </div>
    <!-- END Page Content -->
    <!-- END Stats -->
</main>
@endsection