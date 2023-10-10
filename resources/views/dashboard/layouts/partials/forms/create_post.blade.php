@php
    $defaultImage ='assets/images/profile-carousel/avator.png';
    $title = (!empty($post) ? ($post->title) : null);
    $body  = (!empty($post) ? ($post->body) : null);
     $id  =  (!empty($post) ? ($post->id) : null);
@endphp
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Post</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Create Post</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row"><div class="col-md-3">
                @if($id)
                 {{--   <a href="{{ route('dashboard.user.post.index')}}"
                       class="btn btn-primary btn-block mb-3">Delete Your Post</a>--}}
                    {!! Form::open(['method' => 'DELETE', 'route' => ['dashboard.user.post.destroy', $id],
                                    'onsubmit' => 'return confirm("Are you sure?")', 'id'=>'himan']) !!}
                    <button class="btn btn-primary btn-block mb-3">Delete Your Post</button>
                    {!! Form::close() !!}

                @else
                    <a href="{{ route('dashboard.user.post.index')}}"
                       class="btn btn-primary btn-block mb-3">Back to Post List</a>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Folders</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-inbox"></i> Inbox
                                    <span class="badge bg-primary float-right"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-envelope"></i> Sent
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-file-alt"></i> Drafts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-filter"></i> Junk
                                    <span class="badge bg-warning float-right"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-trash-alt"></i> Trash
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Write New Post</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                            <a href="">
                                                <i class="fas fa-users"></i>
                                            </a></li>
                                    </ol>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.card-header -->
                    @if( $id)
                        {!! Form::open(['route' => ['dashboard.user.post.update', ['post'=> $id]], 'method' => 'PUT',
                        'class' => 'form', 'files' => false]) !!}
                    @else
                        {!! Form::open(['route' => ['dashboard.user.post.store'], 'method' => 'POST', 'class' => 'form', 'files' => false]) !!}
                    @endif

                    {{--{!! Form::open(['route' => 'dashboard.user.post.store', 'method' => 'POST', 'enctype' => 'multipart/form-data',
                    'class' => 'form', 'id' => 'editfrom']) !!}--}}
                        {!! Form::token() !!}
                        <div class="card-body">
                        <div class="form-group">
                            {!! Form::text("title",  $title, ['class' => 'form-control', 'required' => 'required','placeholder' => 'Title...']) !!}
                        </div>
                        <div class="form-group">
                          {!! Form::textarea("body",$body,
                            ['id' =>'xsummernote','placeholder' => 'write here...', 'required' => 'required','class' => 'form-control', 'rows' => 10, 'cols' => 40]) !!}
                        </div>
                            {{ Form::hidden('id', $id) }}
                        {{--<div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fas fa-paperclip"></i> Attachment
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">Max. 32MB</p>
                        </div>--}}
                    </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

