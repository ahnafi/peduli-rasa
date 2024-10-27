<?php
$image = [
    [
        "img" => "/images/banners/bengkel-motor.jpg",
        "alt" => "bengkel motor"
    ],
    [
        "img" => "/images/banners/laundry.jpg",
        "alt" => "laundry"

    ],
    [
        "img" => "/images/banners/warung-makan.webp",
        "alt" => "warung makan"
    ],
    [
        "img" => "/images/banners/buka-bersama.png",
        "alt" => "buka bersama"
    ]
];
?>
<div class="pt-20 md:pt-24 max-w-screen-lg aspect-video md:aspect-[21/9] container section-padding-x">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach ($image as $img): ?>
                <div class="swiper-slide">
                    <img
                            src="<?= $img["img"] ?>"
                            alt="<?= $img["alt"] ?>"
                            class="w-full object-cover rounded-lg"
                    />
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<script>
    let swiper = new Swiper(".mySwiper", {
        pagination: {
            clickable: true,
            el: ".swiper-pagination",
        },
        loop: true,
        autoplay: {
            delay: 2500,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>

<style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>