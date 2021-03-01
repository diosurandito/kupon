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

    <!-- Page Content -->
    <div class="content content-narrow">
        <!-- Stats -->
        <div class="row">
            

        </div>
    </div>
    <!-- END Stats -->
</main>
@endsection