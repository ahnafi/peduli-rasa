<?php
$title = $model["title"] ?? "";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="description" content=""/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
          rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <title><?= $title ?> | PeduliRasa</title>
    <script src="/script/"></script>
</head>
<body class="font-nunito">

<?php
use PeduliRasa\App\Flasher;
Flasher::FLASH();
?>

<nav class="bg-light-base fixed w-full z-[999] normal-font-size">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="/logo.png" class="w-12" alt="PeduliRasa Logo"/>
        </a>
        <div class="flex lg:order-2 gap-8">
            <div>
                <button type="button" aria-controls="navbar-search"
                        class="lg:hidden text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg text-sm p-2.5 me-1"
                        id="search-button">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
                <div class="relative hidden lg:block">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                        </svg>
                        <span class="sr-only">Search icon</span>
                    </div>
                    <form action="/post/search" method="get">
                        <input type="text" id="search-navbar"
                               class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none"
                               placeholder="Search..." name="title"/>
                    </form>
                </div>
                <button type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        aria-controls="navbar-search"
                        id="toggle-button">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"></path>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between gap-8 hidden lg:flex">
                <a href="/login" class="block text-dark-base rounded-lg border border-dark-base py-1 px-3 font-bold">
                    Masuk
                </a>
                <a href="/register" class="block text-light-base bg-green-base py-1 px-3 border border-green-base rounded-lg font-bold" >
                    Daftar
                </a>
            </div>
        </div>
        <div id="navbar-search" class="items-center justify-between w-full lg:flex lg:w-auto lg:order-1 hidden" >
            <div class="relative mt-3 lg:hidden">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 20 20" >
                        <path stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z">
                        </path>
                    </svg>
                </div>
                <form action="/post/search" method="get">
                <input type="text"
                        id="search-navbar"
                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none"
                        placeholder="Search..." />
                </form>
            </div>
            <ul class="flex flex-col p-4 lg:p-0 mt-4 font-medium border rounded-lg lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0" >
                <li>
                    <a href="/" class="block py-2 px-3 text-dark-base rounded font-bold md:py-1 md:px-2 lg:p-0" >
                        Home
                    </a>
                </li>
                <li>
                    <a href="/ayo-berbagi" class="block py-2 px-3 text-dark-base rounded font-bold md:py-1 md:px-2 lg:p-0" >
                        Ayo Berbagi
                    </a>
                </li>
                <li>
                    <a href="/tentang-kami" class="block py-2 px-3 text-dark-base rounded font-bold md:py-1 md:px-2 lg:p-0" >
                        Tentang Kami
                    </a>
                </li>
                <li>
                    <a href="/login" class="block py-2 px-3 text-dark-base rounded font-bold md:py-1 md:px-2 lg:p-0 lg:hidden" >
                        Masuk
                    </a>
                </li>
                <li>
                    <a  href="/register" class="block py-2 px-3 text-dark-base rounded font-bold md:py-1 md:px-2 lg:p-0 bg-green-base text-light-base lg:hidden" >
                        Masuk
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    const toggleNavbar = () => {
        const navbar = document.getElementById("navbar-search");
        navbar.classList.toggle("hidden");
    };

    document.addEventListener("DOMContentLoaded", () => {
        const toggleButton = document.getElementById("toggle-button");
        const searchButton = document.getElementById("search-button");
        toggleButton.addEventListener("click", toggleNavbar);
        searchButton.addEventListener("click", toggleNavbar);
    });
</script>
