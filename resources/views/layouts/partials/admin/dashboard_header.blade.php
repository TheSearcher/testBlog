<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('index')}}" class="nav-link">Home</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @auth
            @if(auth()->user()->can('authenticated-user-can-access') )

             <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('dashboard.user.post.create')}}" class="nav-link">Add Blog</a>
            </li>
            @endif
        @endauth
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('logs.outs')}}" class="nav-link">Logout</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>

    </ul>
</nav>
