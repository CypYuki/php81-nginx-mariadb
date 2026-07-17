@extends('layouts.app')

@section('title', '新規投稿')

@section('content')

    <div class="grid grid-cols-1 gap-4 my-4">
        <h1 class="text-center text-2xl font-bold mb-4">新規投稿</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-6">
                <label for="images" class="block text-gray-700 font-bold mb-2">画像</label>
                <input type="file" name="images[]" id="images" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-sky-500 focus:outline focus:outline-sky-500" multiple>
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">タイトル</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-sky-500 focus:outline focus:outline-sky-500" required>
            </div>
            <div class="mb-6">
                <label for="body" class="block text-gray-700 font-bold mb-2">内容</label>
                <textarea name="body" id="body" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-sky-500 focus:outline focus:outline-sky-500" required></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">投稿する</button>
            </div>
        </form>
    </div>
@endsection
