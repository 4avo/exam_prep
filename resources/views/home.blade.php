<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @auth
    <p>Congrats you are logged in!</p>
    <form action="/logout" method="POST">
        @csrf
        <BUTton>Log out</BUTton>
    </form>

    <div style='border: 3px solid black;'>
        <h2>Create new Post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name='title' placeholder="post title">
            <textarea name="body" placeholder="body content..."></textarea>
            <button>Save Post</button>
        </form>
    </div>
    <div style='border: 3px solid black;'>
        <h2>All posts</h2>
        @foreach($posts as $post)
        <div style='border: 1px solid black;'>
            <h1>{{$post['title']}}</h1>
            {{$post['body']}}
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method='POST'>
                @csrf
                @method('DELETE')
                <BUTTon>Delete</BUTTon>
            </form>
        </div>
        @endforeach
    @else
    <div style='border: 3px solid black;'>
        <h2>Register</h2>
        <form action="/register" method='POST'>
            @csrf
            <input name='name' type="text" placeholder="name">
            <input name='email' type="text" placeholder="email">
            <input name='password' type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>
    <div style='border: 3px solid black;'>
        <h2>Log in</h2>
        <form action="/login" method='POST'>
            @csrf
            <input name='loginname' type="text" placeholder="name">
            <input name='loginpassword' type="password" placeholder="password">
            <button>Log in</button>
        </form>
    </div>
    @endauth

    
</body>
</html>