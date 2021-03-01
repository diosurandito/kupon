<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('templates.admin.partials._head')
<body>
  <div id="page-container" class="sidebar-o sidebar-dark @if(Request::is('#')) sidebar-mini @endif enable-page-overlay side-scroll page-header-dark page-header-fixed">


    <!-- Sidebar -->
    @include('templates.admin.partials._sidebar')
    <!-- End Sidebar -->
    <!-- Header -->
    @include('templates.admin.partials._header')
    <!-- End Header -->

    <!-- Content  -->

    @yield('content')
    

    <!-- End Content -->

    <!-- Footer -->
    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
      <div class="content py-3">
        <div class="row font-size-sm">
          <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
            <a class="font-w600" href="" target="_blank">PT. Jaya Kreasi Indonesia</a> &copy; <span data-toggle="year-copy">2020</span>
          </div>
          <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">

          </div>
        </div>
      </div>
    </footer>

    <!-- END Footer -->
  </div>
  @include('templates.admin.partials._script')

</body>
</html>