<?php

$post = null;
$images = [];
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$url = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (isset($model["post"])) {
    $post = $model["post"];
    $images = $model["post"]["images"];
}
?>

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

    .swiper-slide {
        position: relative;
    }

    <?php foreach ($images as $image) : ?>
    @media screen and (min-width: 768px) {
        .swiper-slide::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.4;
            background: url("/images/posts/<?= $image->imageName ?>") no-repeat center center;
            background-size: cover;
            z-index: -1;
        }
    }
    <?php endforeach; ?>
</style>

<main id="detail-product" class="pt-20 w-full flex justify-between flex-col md:flex-row ">
    <div class="w-full md:w-3/5 h-[216px] md:h-auto">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($images as $image) : ?>
                    <div class="swiper-slide">
                        <img src="/images/posts/<?= $image->imageName ?>" alt="banner <?= $post["title"] ?>"
                             class="max-w-md object-cover rounded-lg max-h-[720px]"/>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <section id="product-detail-header" class="section-padding-x pt-4 pb-4 md:w-2/5">
        <div class="container max-w-screen-sm">
            <div class="flex items-center gap-2 border-b-2 border-b-gray-400 pb-2">
                <img src="/images/profile/<?= $post["user"]->profilePhoto ?? "profile.svg" ?>"
                     alt="Foto profil <?= $post["user"]->profilePhoto ?? "user" ?>" class="rounded-full w-10 aspect-square"/>
                <p class="small-font-size font-semibold"><?= $post["user"]->username ?? "user" ?></p>
            </div>
            <div class="mb-2 mt-2">
                <h1 class="product-title-font-size font-bold">
                    <?= $post["title"] ?>
                </h1>
                <p class="small-font-size text-gray-600 font-light">
                    Ditawarkan <span id="createAt"><?= $post["createdAt"] ?></span> yang lalu di <?= $post["location"] ?>
                </p>
            </div>
            <div class="flex gap-2 items-center mb-4">
                <a target="_blank" href="https://wa.me/<?= $post["user"]->phoneNumber ?? "" ?>?text=Apakah postingan ini masih berlaku?%0A<?=$url?>" class="rounded-lg bg-green-base text-light-base h-9 px-2 items-center flex gap-2" >
                    <img src="/images/icons/whatsapp.png" alt="Whatsapp Icon" class="h-6 w-6 aspect-square" />
                    <span class="normal-font-size">Kirim pesan</span>
                </a>
                <button type="button" class="w-9 h-9 aspect-square rounded-lg bg-gray-300 px-2" onclick="copyLink()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" >
                        <path d="M307 34.8c-11.5 5.1-19 16.6-19 29.2v64H176C78.8 128 0 206.8 0 304C0 417.3 81.5 467.9 100.2 478.1c2.5 1.4 5.3 1.9 8.1 1.9c10.9 0 19.7-8.9 19.7-19.7c0-7.5-4.3-14.4-9.8-19.5C108.8 431.9 96 414.4 96 384c0-53 43-96 96-96h96v64c0 12.6 7.4 24.1 19 29.2s25 3 34.4-5.4l160-144c6.7-6.1 10.6-14.7 10.6-23.8s-3.8-17.7-10.6-23.8l-160-144c-9.4-8.5-22.9-10.6-34.4-5.4z"></path>
                    </svg>
                </button>
            </div>
            <div class="">
                <h2 class="subtitle-font-size font-bold mb-2">Detail</h2>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between">
                        <h3 class="normal-font-size font-medium">Berlaku Sampai</h3>
                        <p class="normal-font-size" id="postDate"><?= $post["postDate"]?></p>
                    </div>
                    <div class="flex justify-between">
                        <h3 class="normal-font-size font-medium">Kategori</h3>
                        <p class="normal-font-size"><?= $post["category"]?></p>
                    </div>
                    <p class="small-font-size">
                        <?= $post["description"] ?>
                    </p>
                    <div class="relative text-right w-full h-52 rounded-lg">
                        <div class="overflow-hidden bg-none w-full h-full">
                            <iframe
                                    class="w-full h-full"
                                    frameborder="0"
                                    scrolling="no"
                                    marginheight="0"
                                    marginwidth="0"
                                    src="https://maps.google.com/maps?width=600&height=200&hl=en&q=universitas jenderal soedirman&t=&z=14&ie=UTF8&iwloc=B&output=embed"
                            ></iframe>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <h3 class="normal-font-size font-medium">Perkiraan lokasi</h3>
                        <p class="normal-font-size"><?= $post["location"] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

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

    function copyLink() {
        let link = window.location.href;
        if (navigator.clipboard && navigator.clipboard.writeText) {
            // Metode modern
            navigator.clipboard.writeText(link).then(() => {
                Swal.fire({
                    icon: "success",
                    title: "Link berhasil dicopy",
                    showConfirmButton: false,
                    timer: 1000
                });
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Link gagal dicopy",
                    showConfirmButton: false,
                    timer: 1000
                });
            });
        } else {
            // Fallback
            Swal.fire({
                icon: "error",
                title: "Link gagal dicopy",
                showConfirmButton: false,
                timer: 1000
            });
        }
    }

    const createdAt = document.getElementById("createAt").innerText;
    let timeNow = timeAgo(createdAt);
    document.getElementById("createAt").innerText = timeNow;

    const postDate = document.getElementById("postDate").innerText;
    let timePost = formatDate(postDate);
    document.getElementById("postDate").innerText = timePost;

</script>