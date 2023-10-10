<div class="wrapper">
    <!-- Preloader -->
    {{--<div class="preloader flex-column justify-content-center align-items-center">
        --}}{{--<img class="animation__wobble" src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">--}}{{--
    </div>--}}
    {{--@include('layout.partials.members.dashboard_header')--}}

    <!-- Navbar -->
    @include('layouts.partials.admin.dashboard_main_nav_sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('layouts.partials.flash-message')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; Endy Ofo 2023  </strong>
          All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        </div>
    </footer>
</div>
<!-- REQUIRED jQuery SCRIPTS -->
@include('layouts.partials.admin.dashboard_foot-scripts')
