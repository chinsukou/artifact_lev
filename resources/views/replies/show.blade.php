<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
    <div class"mx-auto container">
        <!--カテゴリー-->
        <!--本文-->
        <div class="content">
           <div class="content_post">
               <p>{{ $post->title }}</p>
               <p>{{ $post->body }}</p>
                @auth
                <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
                @if (!$post->isLikedBy(Auth::user()))
                    <span class="likes">
                        <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                    </span><!-- /.likes -->
                @else
                    <span class="likes">
                        <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                    </span><!-- /.likes -->
                @endif
                @endauth
           </div>
        </div>
        <!--返信-->
        <div class="content">
           <div class="content_post">
               <p>{{ $reply->body }}</p>
           </div>
        </div>
        <br>
        <!--コメント一覧表示-->
        <div class="content_reply">
            @foreach($comments as $comment)
                <div class="content">
                    <div class="content_contents">
                        <br>
                        <p>{{ $comment->body }}</p>
                    </div>
                </div>
                <br>
            @endforeach
            <a href='/comments/create/{{ $reply->id }}'>コメントする</a>
        </div>
    </div>
    <div class="footer">
        <a href="/posts/{{ $post->id }}">戻る</a>
    </div>
</x-app-layout>