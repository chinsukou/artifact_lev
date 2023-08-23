<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>投稿詳細</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <!--タイトル-->
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <!--カテゴリー-->
        <a fref="">{{ $post->category->name }}</a>
        <!--本文-->
        <div class='content'>
           <div class="content_post">
               <h3>本文</h3>
               <p>{{ $post->body }}</p>
           </div>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>