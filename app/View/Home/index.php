<?php
$foodAndDrink = $model['foodAndDrink'] ?? [];
$events = $model['activity'] ?? [];

if(count($foodAndDrink) > 8){
    $foodAndDrink = array_slice($foodAndDrink, 0, 8);
}

if(count($events) > 8){
    $events = array_slice($events, 0, 8);
}

include_once __DIR__ . "/../Components/Swiper.php";
?>

<div class="pt-8 pb-8 section-padding-x">
    <div class="container max-w-screen-xl">
        <div class="mb-8">
            <h2 class="sub-header-font-size font-bold mb-2">Makanan dan minuman</h2>
            <div class="flex items-center justify-between mb-4">
                <div class="flex justify-between items-center">
                    <ul class="items-center justify-between gap-4 hidden md:flex">
                        <li>
                            <a href="/post/search?categories=1,2,3"
                               class="py-1 px-2 border extra-small-font-size border-dark-base rounded-lg  bg-dark-base text-light-base">
                                Semua
                            </a>
                        </li>
                        <li>
                            <a href="/post/search?categories=1"
                               class="py-1 px-2 border extra-small-font-size border-dark-base rounded-lg text-dark-base ">
                                Makanan Basah
                            </a>
                        </li>
                        <li>
                            <a href="/post/search?categories=2"
                               class="py-1 px-2 border extra-small-font-size border-dark-base rounded-lg text-dark-base ">
                                Makanan Kering
                            </a>
                        </li>
                        <li>
                            <a href="/post/search?categories=3"
                               class="py-1 px-2 border extra-small-font-size border-dark-base rounded-lg text-dark-base ">
                                Minuman
                            </a>
                        </li>
                    </ul>
                    <div class="relative group block md:hidden extra-small-font-size">
                        <button id="food-and-drink-dropdown-button"
                                class="inline-flex justify-center items-center w-full px-3 py-1 md:px-4 md:py-2 font-medium bg-white-base border border-slate-300 rounded-md shadow-sm focus:outline-none">
                            <span class="mr-2">Kategori</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                      clip-rule="evenodd">
                                </path>
                            </svg>
                        </button>
                        <div id="food-and-drink-dropdown"
                             class="absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1 hidden">
                            <a href="/post/search?categories=1,2,3"
                               class="block w-full px-3 py-1 md:px-4 md:py-2 text-gray-700 hover:bg-gray-100 cursor-pointer rounded-md">
                                Semua
                            </a>
                            <a href="/post/search?categories=1"
                               class="block w-full px-3 py-1 md:px-4 md:py-2 text-gray-700 hover:bg-gray-100 cursor-pointer rounded-md">
                                Makanan Kering
                            </a>
                            <a href="/post/search?categories=2"
                               class="block w-full px-3 py-1 md:px-4 md:py-2 text-gray-700 hover:bg-gray-100 cursor-pointer rounded-md">
                                Makanan Basah
                            </a>
                            <a href="/post/search?categories=3"
                               class="block w-full px-3 py-1 md:px-4 md:py-2 text-gray-700 hover:bg-gray-100 cursor-pointer rounded-md">
                                Minuman
                            </a>
                        </div>
                    </div>
                </div>
                <a href="/post/search?categories=1,2,3" class="extra-small-font-size text-blue-base">Lihat
                    selengkapnya</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-between">
                <?php if(count($foodAndDrink) <= 0) : ?>
                    <h3 class="sub-header-font-size text-center font-bold col-span-4">Belum ada info makanan dan minuman</h3>
                <?php else: ?>
                <?php foreach ($foodAndDrink as $post) : ?>
                    <div class="card max-w-[300px] aspect-square bg-white border border-gray-200 rounded-lg shadow">
                        <a href="/post/detail/<?= $post->id ?>">
                            <img class="rounded-t-lg object-cover w-full max-h-[200px] aspect-square"
                                 src="/images/posts/<?= $post->bannerImage ?>" alt="banner <?= $post->title ?>"/>
                        </a>
                        <div class="p-3">
                            <p class="price-title-font-size text-gray-700 flex items-center gap-2 extra-small-font-size">
                                <svg class="w-4 h-4 text-gray-700" viewBox="0 0 14 17" fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.94515 0.953796C3.46182 0.953796 0.611816 3.8038 0.611816 7.28713C0.611816 11.5621 6.15348 16.3913 6.39098 16.6288C6.54932 16.708 6.78682 16.7871 6.94515 16.7871C7.10348 16.7871 7.34098 16.708 7.49932 16.6288C7.73682 16.3913 13.2785 11.5621 13.2785 7.28713C13.2785 3.8038 10.4285 0.953796 6.94515 0.953796ZM6.94515 14.9663C5.28265 13.383 2.19515 9.9788 2.19515 7.28713C2.19515 4.67463 4.33265 2.53713 6.94515 2.53713C9.55765 2.53713 11.6952 4.67463 11.6952 7.28713C11.6952 9.89963 8.60765 13.383 6.94515 14.9663ZM6.94515 4.12046C5.20348 4.12046 3.77848 5.54546 3.77848 7.28713C3.77848 9.0288 5.20348 10.4538 6.94515 10.4538C8.68682 10.4538 10.1118 9.0288 10.1118 7.28713C10.1118 5.54546 8.68682 4.12046 6.94515 4.12046ZM6.94515 8.87046C6.07432 8.87046 5.36182 8.15796 5.36182 7.28713C5.36182 6.4163 6.07432 5.7038 6.94515 5.7038C7.81598 5.7038 8.52848 6.4163 8.52848 7.28713C8.52848 8.15796 7.81598 8.87046 6.94515 8.87046Z"/>
                                </svg>
                                <span><?= $post->location ?></span>
                            </p>
                            <h5 class="card-title-font-size font-bold tracking-tight line leading-3 text-dark-base">
                                <a href="/post/detail/<?= $post->id ?>"><?= truncateText($post->title,20) ?></a>
                            </h5>
                            <p class="description-card-font-size font-normal text-gray-700">
                                <?= truncateText($post->description, 35) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="">
            <h2 class="sub-header-font-size font-bold mb-2">
                Acara yang sedang berlangsung
            </h2>
            <div class="flex items-center justify-between mb-4">
                <div class="flex justify-between items-center">
                    <ul class="items-center justify-between gap-4 hidden md:flex">
                        <li>
                            <a href="/post/search?categories=4,5,6"
                               class="py-1 px-2 border extra-small-font-size border-dark-base rounded-lg bg-dark-base text-light-base">
                                Semua
                            </a>
                        </li>
                        <li>
                            <a href="/post/search?categories=4"
                               class="py-1 px-2 border extra-small-font-size border-dark-base rounded-lg text-dark-base ">
                                Jumat Berkah
                            </a>
                        </li>
                            <a href="/post/search?categories=5"
                               class="py-1 px-2 border extra-small-font-size border-dark-base rounded-lg text-dark-base ">
                                Peduli Sosial
                            </a>
                        </li>
                        <li>
                            <a href="/post/search?categories=6"
                               class="py-1 px-2 border extra-small-font-size border-dark-base rounded-lg text-dark-base ">
                                Bakti Sosial
                            </a>
                        </li>
                    </ul>
                    <div class="relative group block md:hidden extra-small-font-size">
                        <button id="event-dropdown-button"
                                class="inline-flex justify-center items-center w-full px-3 py-1 md:px-4 md:py-2 font-medium bg-white-base border border-slate-300 rounded-md shadow-sm focus:outline-none">
                            <span class="mr-2">Kategori</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 ml-2 -mr-1"
                                 viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div id="event-dropdown"
                             class="absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1 hidden">
                            <a href="/post/search?categories=4,5,6"
                               class="block w-full px-3 py-1 md:px-4 md:py-2 text-gray-700 hover:bg-gray-100 cursor-pointer rounded-md">
                                Semua
                            </a>
                            <a href="/post/search?categories=4"
                               class="block w-full px-3 py-1 md:px-4 md:py-2 text-gray-700 hover:bg-gray-100 cursor-pointer rounded-md">
                                Jumat Berkah
                            </a>
                            <a href="/post/search?categories=5"
                               class="block w-full px-3 py-1 md:px-4 md:py-2 text-gray-700 hover:bg-gray-100 cursor-pointer rounded-md">
                                Peduli Sosial
                            </a>
                            <a href="/post/search?categories=6"
                               class="block w-full px-3 py-1 md:px-4 md:py-2 text-gray-700 hover:bg-gray-100 cursor-pointer rounded-md">
                                Bakti Sosial
                            </a>
                        </div>
                    </div>
                </div>
                <a href="/post/search?categories=4,5,6" class="extra-small-font-size text-blue-base">
                    Lihat selengkapnya
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-between">
                <?php if(count($events) <= 0) : ?>
                    <h3 class="sub-header-font-size text-center font-bold col-span-4">Belum ada info kegiatan</h3>
                <?php else: ?>
                <?php foreach ($events as $event): ?>
                    <div class=" max-w-[300px] aspect-square bg-white border border-gray-200 rounded-lg shadow">
                        <a href="/post/detail/<?= $event->id ?>">
                            <img class="rounded-t-lg object-cover w-full max-h-[200px] aspect-square"
                                 src="/images/posts/<?= $event->bannerImage ?>" alt="<?= $event->title ?>"/>
                        </a>
                        <div class="p-3">
                            <p class="price-title-font-size text-gray-700 flex items-center gap-2 extra-small-font-size">
                                <svg class="w-4 h-4 text-gray-700" viewBox="0 0 14 17" fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.94515 0.953796C3.46182 0.953796 0.611816 3.8038 0.611816 7.28713C0.611816 11.5621 6.15348 16.3913 6.39098 16.6288C6.54932 16.708 6.78682 16.7871 6.94515 16.7871C7.10348 16.7871 7.34098 16.708 7.49932 16.6288C7.73682 16.3913 13.2785 11.5621 13.2785 7.28713C13.2785 3.8038 10.4285 0.953796 6.94515 0.953796ZM6.94515 14.9663C5.28265 13.383 2.19515 9.9788 2.19515 7.28713C2.19515 4.67463 4.33265 2.53713 6.94515 2.53713C9.55765 2.53713 11.6952 4.67463 11.6952 7.28713C11.6952 9.89963 8.60765 13.383 6.94515 14.9663ZM6.94515 4.12046C5.20348 4.12046 3.77848 5.54546 3.77848 7.28713C3.77848 9.0288 5.20348 10.4538 6.94515 10.4538C8.68682 10.4538 10.1118 9.0288 10.1118 7.28713C10.1118 5.54546 8.68682 4.12046 6.94515 4.12046ZM6.94515 8.87046C6.07432 8.87046 5.36182 8.15796 5.36182 7.28713C5.36182 6.4163 6.07432 5.7038 6.94515 5.7038C7.81598 5.7038 8.52848 6.4163 8.52848 7.28713C8.52848 8.15796 7.81598 8.87046 6.94515 8.87046Z"/>
                                </svg>
                                <span><?= $event->location ?></span>
                            </p>
                            <h5 class="card-title-font-size font-bold tracking-tight text-dark-base">
                                <a href="/post/detail/<?= $event->id ?>"><?=truncateText($event->title,20) ?></a>
                            </h5>
                            <p class="truncate text-ellipsis description-card-font-size font-normal text-gray-700 ">
                                <?= truncateText($event->description, 35) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif;?>
            </div>
        </div>

    </div>
</div>

<script>
    const foodDropdown = () => {
        const dropdown = document.querySelector("#food-and-drink-dropdown");
        dropdown.classList.toggle("hidden");
    };

    const eventDropdown = () => {
        const dropdown = document.querySelector("#event-dropdown");
        dropdown.classList.toggle("hidden");
    };

    document.addEventListener("DOMContentLoaded", () => {
        const foodCategoryButton = document.getElementById(
            "food-and-drink-dropdown-button"
        );
        const eventCategoryButton = document.getElementById("event-dropdown-button");

        eventCategoryButton.addEventListener("click", eventDropdown);
        foodCategoryButton.addEventListener("click", foodDropdown);
    });
</script>