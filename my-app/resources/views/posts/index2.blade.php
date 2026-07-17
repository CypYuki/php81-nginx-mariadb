@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')
    <x-alert type="warning">
        これは警告メッセージです。
    </x-alert>


    <h1 class="text-center h-16">index2のタイトルです</h1>
    @foreach ($posts as $post)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <h2 class="text-xl font-bold">タイトル名: {{ $post->title }}</h2>
        <p>本文：{{ $post->body }}</p>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
            投稿する
        </button>
    
    </div>
    @endforeach
@endsection