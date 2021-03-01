@if(session('success'))
    <div class="alert alert-success alert-dismissable" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		</button>
        <p class="mb-0"> {{ session('success') }} Login Terlebih Dahulu Untuk Mendapatkan Token Verifikasi</p>
    </div>
@endif