@extends('layouts.app')

@section('title', '投稿詳細')

@section('content')


    <div class="grid grid-cols-1 gap-4 my-4">
        <div class="overflow-hidden shadow-lg rounded-lg h-90 w-60 md:w-80 cursor-pointer my-2 mx-auto shadow-md">
            <div class="swiper">
                <div class="swiper-wrapper">
                @if ($post->postImages->count() > 0)
                    @foreach ($post->postImages as $postImage)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $postImage->url) }}" alt="Post Image" >
                    </div>
                    @endforeach
                @else
                    <div class="swiper-slide">
                    <img src="https://picsum.photos/200" alt="Default Image" class="mb-2 w-full h-40 object-cover">
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
        </div>
    </div>
    <!-- 削除ボタン -->
    <div class="grid grid-cols-1 my-2">
        <div class="justify-self-center mb-6">
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="bg-green-500  text-white hover:bg-white hover:text-green-500 outline outline-1 font-bold py-2 px-4 w-36 rounded cursor-pointer">編集する</a>
        </div>
        <div class="justify-self-center mb-6">
            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" >
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirmDelete()" class="bg-red-800 text-white hover:bg-white hover:text-red-500 outline outline-1 font-bold py-2 px-4 w-36 rounded cursor-pointer">投稿を削除</button>
            </form>
        </div>

    </div>
    <script>
        function confirmDelete() {
            return confirm('本当にこの登録を削除しますか？');
        }
    </script>

@endsection
