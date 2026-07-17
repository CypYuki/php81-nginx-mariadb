
<!DOCTYPE html>
<html>
    <head>
        <style>
.swiper {
    width: 100%;
    height: 190px;
    position: relative;
}

.swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.swiper-button-next,
.swiper-button-prev {
    color: #007aff;
    z-index: 10;
}
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!--swiperのcssとjsを読み込む-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
        {{-- flowbiteのcssとjsを読み込む --}}
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

        <title>@yield('title')</title>

    </head>
    <body>
        <header style="background-color: #5492d0; padding: 10px;text-align: center;">
            <a href="{{ route('posts.index') }}" class="text-white font-bold text-lg">
                <h1>インスタグラム風アプリ</h1>
            </a>

        </header>
        <div class="content">
            @yield('content')
        </div>
        <footer style="background-color: #5492d0; padding: 10px; text-align: center;">
            <p>&copy; 2026 インスタグラム風アプリ</p>
        </footer>
    </body>

    <script>

    const swiper = new Swiper('.swiper', {
        loop: true,
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
        },

    });

    </script>
</html>
