



<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header" style="background-color: #ffffff61;padding-left: 12px;">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="">
            <img src="{{ asset('assets/media/photos/logo_jki.png') }}" style="width: 30px;">
            <span class="smini-hide">
                <span class="font-w700 font-size-h5">PTV_JKI</span>
            </span>
        </a>
        <!-- END Logo -->


    </div>
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link @if (Request::is('home')) active @endif" href="{{route('home')}}">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
        
        </ul>

    </div>
    <!-- END Side Navigation -->
</nav>
<!-- END Sidebar -->
