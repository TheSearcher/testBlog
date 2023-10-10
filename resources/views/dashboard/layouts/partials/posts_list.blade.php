@php
    $defaultImage ='default.jpeg';
@endphp

    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $datas->total() }} Posts</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Inbox</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('dashboard.user.post.create')}}" class="btn btn-primary btn-block mb-3">Create Post</a>

            @include ('dashboard.layouts.partials.features._inbox')
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Post List</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Search Mail">
                            <div class="input-group-append">
                                <div class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" id="master" class="btn btn-default btn-sm checkbox-toggle">
                            <i class="far fa-square"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" id="delete_all" class="btn btn-default btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-reply"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-share"></i>
                            </button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                        <div class="float-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            <!-- /.btn-group -->
                        </div>
                        <!-- /.float-right -->
                    </div>
                    @if($datas->total())
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                @foreach($datas as $data)
                                    @php
                                        $image = ($data->image) ? ($data->image) : $defaultImage;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value=""
                                                       class="forms-check-input" data-id="{{$data->post_id}}" id="XXcheck1">
                                                <label for="check1"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star">
                                            <a href="{{ route('post.show',['post'=> $data->post_id])}}">
                                                <img
                                                    src="{{ asset("uploads/$image") }}"
                                                    alt=""
                                                    style="width: 45px; height: 45px"
                                                    class="rounded-circle"
                                                />
                                            </a>
                                        </td>
                                        <td class="mailbox-subject">
                                            @auth
                                                @if(auth()->user()->can('authenticated-user-can-access'))
                                                    <a href="{{ route('dashboard.user.post.edit',['post'=> $data->post_id])}}">
                                                        <p class="fw-normal mb-1">{{ date('D, h:i A,  j M y', strtotime($data->created_at)) }}</p>
                                                        <p class="text-muted mb-0">
                                                            {{ Illuminate\Support\Str::limit($data->title,30, '') }}
                                                            <b>&nbsp;&nbsp;Edit</b>
                                                        </p>
                                                    </a>
                                                @endif
                                                @if(auth()->user()->can('admin-can-access'))
                                                        <a href="{{ route('post.show',['post'=> $data->post_id])}}">
                                                            <p class="fw-normal mb-1">{{ date('D, h:i A,  j M y', strtotime($data->created_at)) }}</p>
                                                            <p class="text-muted mb-0">
                                                                {{ Illuminate\Support\Str::limit($data->title,30, '') }}
                                                                <b>&nbsp;read</b>
                                                            </p>
                                                        </a>
                                                @endif
                                            @endauth
                                        </td>
                                        <td>
                                            <a href="{{ route('post.show',['post'=> $data->post_id])}}" class="addToFavourites  btn btn-primary btn-sm" data-url=""
                                               data-parent="addToFavourites" data-id="">
                                                {{ $data->comments_count }} comments
                                            </a>
                                        </td>
                                        <td>
                                        <td class="mailbox-subject">
                                            @auth
                                                @if(auth()->user()->can('authenticated-user-can-access'))
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['dashboard.user.post.destroy', $data->post_id],
                                                    'onsubmit' => 'return confirm("Are you sure?")', 'id'=>'himan']) !!}
                                                    <button><i class="far fa-trash-alt"></i></button>
                                                    {!! Form::close() !!}
                                                @endif
                                                @if(auth()->user()->can('admin-can-access'))
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['dashboard.post.destroy', $data->post_id],
                                                        'onsubmit' => 'return confirm("Are you sure?")', 'id'=>'himan']) !!}
                                                        <button><i class="far fa-trash-alt"></i></button>
                                                        {!! Form::close() !!}
                                                @endif
                                            @endauth
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                    @else
                        <h3>You have no posts</h3>
                    @endif

                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer p-0">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                            <i class="far fa-square"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-reply"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-share"></i>
                            </button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                        <div class="float-right">
                            {!! $datas->links() !!}
                            <!-- /.btn-group -->
                        </div>
                        <!-- /.float-right -->
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
