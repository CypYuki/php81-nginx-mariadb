@extends('layouts.app')

@section('title', '投稿編集')

@section('content')

    <div class="grid grid-cols-1 gap-4 my-4">
        <div class="text-left my-4 px-4">
            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="bg-white text-gray-700 outline outline-1 hover:bg-gray-700 hover:text-white py-2 px-4 mx-4 rounded cursor-pointer">戻る</a>
        </div>
        <h1 class="text-center text-2xl font-bold mb-4">投稿編集</h1>
            <form action="{{ route('posts.update') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $post->id }}">
                <input type="file" name="images[]" id="images" multiple>
                <div class="swiper">
                        @if ($post->postImages->count() > 0)
                        <div class="swiper-wrapper my-4">
                            @foreach ($post->postImages as $postImage)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $postImage->url) }}" alt="Post Image" class="mb-2 w-32 h-32 object-cover">
                            </div>
                            @endforeach
                        </div>

                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    @endif
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-sky-500 focus:outline focus:outline-sky-500" required>
                </div>
                <div class="mb-6">
                    <label for="body" class="block text-gray-700 font-bold mb-2">内容</label>
                    <textarea name="body" id="body" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-sky-500 focus:outline focus:outline-sky-500" required>{{ $post->body }}</textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">更新</button>
                </div>
            </form>
    </div>
@endsection
