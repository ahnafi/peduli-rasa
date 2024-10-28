<?php

$posts = $model['posts'] ?? [];

$category = ["Makanan Basah", "Makanan Kering", "Minuman", "Jumat Berkah", "Peduli Sosial", "Bakti Sosial","Semua Kategori"];
$num = $_GET["categories"] ?? 7;
$text = "Kategori \"";

if($num == "1,2,3" or $num == "4,5,6"){
    $text = $category[6];
}else {
    $text .= $category[$num - 1] . "\"";
}

?>
<div class="pt-20 pb-8 section-padding-x min-h-screen">
    <div class="container max-w-screen-xl">
        <div class="mb-8">
            <h2 class="sub-header-font-size font-bold mb-2"> <?= isset($_GET["title"]) ? "Hasil pencarian dari \"" . $_GET["title"] . "\"" : "$text" ?> </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-between">
                <?php foreach ($posts as $post) : ?>
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
                                <a href="/post/detail/<?= $post->id ?>"><?= $post->title ?></a>
                            </h5>
                            <p class="description-card-font-size font-normal text-gray-700">
                                <?= truncateText($post->description, 35) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>