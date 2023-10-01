<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='mx-auto py-2 container'>
      <!--投稿を表示する-->
      <div class='font-semibold'>{{ $category->name }}カテゴリ</div>
      @foreach ($posts as $post)
      <div class='rounded border bg-white hover:bg-gray-100 p-3'>
        <div class='flex justify-between h-fit'>
          <div class='text-sm h-fit'>
            {{ $post->user->name }}
          </div>
          <div class='h-5'>
          @auth
          @if($post->user_id == Auth::user()->id)
            <form action='/posts/{{ $post->id }}' id='form_{{ $post->id }}' method='post'>
              @csrf
              @method('DELETE')
              <button type='button' onclick='deletePost({{ $post->id }})'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
              </button>
            </form>
          @endif
          @endauth
          </div>
        </div>
        <p><a href="/categories/{{ $post->category->id }}">カテゴリー：{{ $post->category->name }}</a></p>
        <p><a href="/difficulties/{{ $post->difficulty->id }}">難易度：{{ $post->difficulty->name }}</a></p>
        <a href="/posts/{{ $post->id }}">
          <h2 class='title'>{{ $post->title }}</h2>
          <p class='body'>{{ $post->body }}</p>
        </a>
        <div class='flex justify-between'>
          <div class='text-sm'>
            {{ $post->created_at }}
          </div>
          <div>
          @auth
          <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
          @if (!$post->isLikedBy(Auth::user()))
          <span class="likes">
            <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
            <span class="like-counter">{{$post->likes_count}}</span>
          </span><!-- /.likes -->
          @else
          <span class="likes">
            <i class="fas fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
            <span class="like-counter">{{$post->likes_count}}</span>
          </span><!-- /.likes -->
          @endif
          @endauth
          </div>
        </div>
      </div>
      @endforeach
      <!--ページネイション-->
      <div class='flex'>
        {{ $posts->links() }}
      </div>
      <div class='flex justify-end p-4'>
      <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
        <a href="/">戻る</a>
      </div>
    </div>
  </div>
  <script>
    function deletePost(id) {
      'use strict'

      if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
        document.getElementById(`form_${id}`).submit();
      }
    }
  </script>
</x-app-layout>