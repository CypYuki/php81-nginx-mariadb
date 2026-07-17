@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')

<div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
      {{ session('success') }}
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
      <span class="sr-only">Dismiss</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
    </button>
</div>


    <div class="grid grid-cols-1 gap-4 my-4">
    <div>
        <a  href="{{ route('posts.create_route') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full cursor-pointer">新規投稿</a>
    </div>
    @foreach ($posts as $post)
            <div class="overflow-hidden shadow-lg rounded-lg h-90 w-60 md:w-80 cursor-pointer my-2 mx-auto shadow-md">
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="w-full block h-full carsol-pointer">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @if ($post->postImages->count() > 0)
                                @foreach ($post->postImages as $postImage)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $postImage->url) }}" alt="Post Image" class="max-h-40 w-full object-cover">
                                </div>
                                @endforeach
                            @else
                                <div class="swiper-slide">
                                    <img src="https://picsum.photos/200" alt="Default Image" class="max-h-40 w-full object-cover">
                                </div>
                            @endif
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <div class="swiper-pagination"></div>

                    </div>
                    <div class="bg-white dark:bg-gray-800 w-full p-4">
                        <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">
                            {{ $post->title }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300 font-light text-md">
                            {{ $post->body }}
                        </p>
                    </div>
                </a>
            </div>
    @endforeach
    </div>
@endsection
