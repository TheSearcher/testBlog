@extends('layouts.masterlayout')

@section('content')
    <div class="container my-12 mx-auto px-4 md:px-12">
    @php
        $defaultImage ='default.jpeg';
    @endphp

    <div class="searchform">
        {!! Form::open(['route' => 'index', 'method' => 'GET',
                         'class' => 'flex items-center', 'id' => 'editfrom']) !!}
            <label for="voice-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <input type="text" id="title"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                        focus:border-blue-500 block w-full pl-10 p-2.5" name="title"  value='' placeholder="Search Title Of Articles..." >
            </div>
            <div class="relative w-full">
                <input type="text" id="body" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"   name="body"  value='' placeholder="Search Blog Articles..." >
            </div>

            <button type="submit" class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>Search</button>
        {!! Form::close() !!}
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
                    <a href="{{route('post.show',['post'=>$data->post_id])}}">
                        <img class="block h-auto w-full" src="{{ asset("uploads/$image") }}" alt="" title="">
                    </a>
                    <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                        <h1 class="text-lg">
                            <a class="no-underline hover:underline text-black" href="{{route('post.show',['post'=>$data->post_id])}}">
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
                                {{ Illuminate\Support\Str::limit($data->user->name, 10, '') }}
                            </p>
                        </a>
                        @auth
                            @if( Auth::user()->id == $data->user_id)
                                <a href="{{route('dashboard.user.post.edit',['post'=>$data->post_id])}}" class="" data-url=""
                                   data-id="">
                                    Edit
                                </a>
                            @endif
                            @if(auth()->user()->can('admin-can-access'))
                                {!! Form::open(['method' => 'DELETE', 'route' => ['dashboard.post.destroy', $data->post_id],
                                    'onsubmit' => 'return confirm("Are you sure?")', 'id'=>'himan']) !!}
                                    <button>Delete</button>
                               {!! Form::close() !!}
                            @endif
                        @endauth
                        <a class="no-underline hover:underline text-black" href="{{route('post.show',['post'=>$data->post_id])}}">
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
</div>

@endsection
