@php
    $defaultImage ='default.jpeg';
@endphp
{{--
{{dd($data)}}--}}

<section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
    <div class="max-w-2xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments ({{$data->comments->count()}})</h2>
        </div>
        @auth
            @if(auth()->user()->can('authenticated-user-can-access') )
                {!! Form::open(['route' => 'dashboard.user.comment.store', 'method' => 'POST',
                         'class' => 'mb-6', 'id' => 'editfrom']) !!}
                {!! Form::token() !!}
                {{ Form::hidden('post_id', $data->id) }}
                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <label for="comment" class="sr-only">Add Your Comment</label>
                    {!! Form::textarea("body",null,
                                ['id' =>'comment','placeholder' => 'Add your comment......',
                                  'class' => 'px-0 w-full text-sm text-gray-900 border-0 focus:ring-0
                                     focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800',
                                     'required' => 'required','rows' => 6, 'cols' => 8]) !!}
                </div>
                <div class="w-full flex justify-end px-3 my-3">
                    <input type="submit" class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500 text-lg" value='Post Comment'>
                </div>
                {!! Form::close() !!}

            @endif
        @endauth
        @if ($data->comments->count())

            @foreach ($data->comments as $key => $data)
                @php
                    $image = ($data->image) ? ($data->image) : $defaultImage;
                @endphp

            {{--{{dd($data)}}--}}

                <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                <img
                                    class="mr-2 w-6 h-6 rounded-full"
                                    src="{{ asset("uploads/$image") }}"
                                    alt="{{ $data->user->name }}">
                                {{ $data->user->name }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <time pubdate datetime="2022-02-08"
                                     title="{{ date('D, h:i A,  j M y', strtotime($data->created_at)) }}">
                                    {{ date('D, h:i A,  j M y', strtotime($data->created_at)) }}
                                </time>
                            </p>
                        </div>

                        @auth
                            @if( Auth::user()->id == $data->user_id)
                                <a href="{{ route('dashboard.user.comment.edit',['comment'=> $data->id])}}" class="" data-url=""
                                data-id="">
                                    Edit
                                </a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['dashboard.user.comment.destroy', $data->id],
                                    'onsubmit' => 'return confirm("Are you sure?")', 'id'=>'himan']) !!}
                                <button>Delete</button>
                                {!! Form::close() !!}
                            @endif
                           @if(auth()->user()->can('admin-can-access'))
                               {!! Form::open(['method' => 'DELETE', 'route' => ['dashboard.comment.destroy', $data->id],
                                   'onsubmit' => 'return confirm("Are you sure?")', 'id'=>'himan']) !!}
                                    <button>Delete</button>
                               {!! Form::close() !!}
                           @endif
                        @endauth
                    </footer>
            <p class="text-gray-500 dark:text-gray-400">
                {{ $data->body }}
            </p>
            <div class="flex items-center mt-4 space-x-4">

            </div>
        </article>
            @endforeach
        @endif
    </div>
</section>
