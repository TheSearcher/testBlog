@extends('layouts.masterlayout')
@section('content')
    @php
        $defaultImage ='default.jpeg';
    @endphp
    <div class="container my-12 mx-auto px-4 md:px-12">
        <h1 class="mt-8 text-lg font-bold">
            {{$data->title}}
        </h1>
        <div class="mt-8 flex flex-wrap">
            <div class="w-full  px-2 mb-4">
                 {{$data->body}}
            </div>
        </div>
    </div>
    @include('layouts.partials.frontend.comments-section')
@endsection
