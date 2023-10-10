
<!DOCTYPE html>
<html lang="en">

<head>
    @if(Route::is('dashboard.*'))
        @include('layouts.partials.admin.dashboard_head')
        @include('layouts.partials.admin.dashboard_header')
    @else
        @include('layouts.partials.frontend.head')
    @endif
</head>

<body class="{{ Route::is('dashboard.*') ? 'hold-transition dark-mode sidebar-mini
            layout-fixed layout-navbar-fixed layout-footer-fixed'
            : 'text-gray-700 bg-white' }}" style="font-family: 'Source Sans Pro', sans-serif">


    @if(Route::is('dashboard.*'))
        @include('layouts.partials.admin.dashboard_body')
    @else
        @include('layouts.partials.frontend.nav')
        @include('layouts.partials.frontend.hero-header')
        @include('layouts.partials.frontend.frontend-body')
    @endif

{{--@yield('content')--}}

{{--<div class="container my-12 mx-auto px-4 md:px-12">
    @php
        $defaultImage ='default.jpeg';
    @endphp

    <div class="searchform">
        <form class="flex items-center">
            <label for="voice-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search Mockups, Logos, Design Templates..." required>
            </div>
            <button type="submit" class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>Search</button>
        </form>
    </div>
    <div class="flex flex-wrap -mx-1 lg:-mx-4">

        @foreach ($datas as $key => $data)
            @php
                $image = ($data->image) ? ($data->image) : $defaultImage;
            @endphp

                <!-- Column -->
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-lg">
                    <a href="{{route('posts.show',['post'=>$data->id])}}">
                        <img class="block h-auto w-full" src="{{ asset("uploads/$image") }}" alt="" title="">
                    </a>
                    <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                        <h1 class="text-lg">
                            <a class="no-underline hover:underline text-black" href="{{route('posts.show',['post'=>$data->id])}}">
                                {{ Illuminate\Support\Str::limit($data->title, 20, '') }}
                            </a>
                        </h1>
                        <p class="text-grey-darker text-sm">
                            {{ date('j M y', strtotime($data->created_at)) }}
                        </p>
                    </header>
                    <p class="flex items-center justify-between leading-tight p-2 md:p-4">
                        {{ Illuminate\Support\Str::limit($data->body, 90, '') }}
                    </p>

                    <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                        <a class="flex items-center no-underline hover:underline text-black" href="#">
                            <img alt="Placeholder" class="block rounded-full" src="https://picsum.photos/32/32/?random">
                            <p class="ml-2 text-sm">
                                peter
                            </p>
                        </a>
                        <a class="no-underline text-grey-darker hover:text-red-dark" href="#">
                            <span class="hidden">Like</span>
                            <i class="fa fa-heart"></i>
                        </a>
                        <a class="no-underline hover:underline text-black" href="{{route('posts.show',['post'=>$data->id])}}">
                            <button type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700
                         rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600
                          dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Read More
                            </button>
                        </a>
                    </footer>
                </article>
                <!-- END Article -->

            </div>
            <!-- END Column -->
        @endforeach

        <div class="row">
            <div class="col-md-12">
                {{ $datas->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>--}}

{{--@include('layouts.partials.frontend.footer')--}}

</body>
</html>



