<!DOCTYPE html>
<html>
<head>
    <title>List of new posts</title>
</head>
<body>
<h3>Hello {{ $mailData['name'] }}</h3>


<h4>List Of New Posts</h4>


@foreach ($mailData['post'] as $key => $data)

    <p><strong>Author:</strong> {{$data['user']['name']}}&nbsp;&nbsp;-&nbsp;&nbsp;
        <strong>Title:</strong> {{ Illuminate\Support\Str::limit($data['title'], 40, '') }}&nbsp;&nbsp;&nbsp;
        <a class="no-underline hover:underline text-black" href="{{route('post.show',['post'=>$data['post_id']])}}">
            <button type="button" class="">
                View Post
            </button>
        </a>

    </p>

@endforeach
<p>Thank you</p>

<p>kind regards</p>
<p>Admin</p>

</body>
</html>
