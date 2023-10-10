<div class="container my-12 mx-auto px-4 md:px-12">
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
@include('layouts.partials.frontend.footer')
{{--@include('layouts.partials.frontend.footer')--}}
