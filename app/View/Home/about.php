<?php
$achievement = [
    ["title" => "1000++",
        "description" => "Porsi makanan telah dibagikan"],
    [
        "title" => "100++",
        "description" => "Acara berbagi makanan",
    ],
    [
        "title" => "500++",
        "description" => "Orang terbantu",
    ]
];

$gallery = [
    [
        'image' => 'https://www.sahabatyatim.com/wp-content/uploads/2021/05/panti-asuhan-min.jpg',
        'title' => 'Bakti sosial di panti asuhan'
    ],
    [
        'image' => 'https://kominfosandi.kamparkab.go.id/wp-content/uploads/2021/09/IMG-20210924-WA0074.jpg',
        'title' => 'Jumat berkah'
    ],
    [
        'image' => 'https://asset-2.tstatic.net/tribunnews/foto/bank/images/aruna-donasi.jpg',
        'title' => 'Donasi buku untuk anak-anak'
    ],
    [
        'image' => 'https://unik-kediri.ac.id/wp-content/uploads/2022/04/WhatsApp-Image-2022-04-28-at-10.47.25.jpeg',
        'title' => 'Pembagian sembako'
    ],
    [
        'image' => 'https://pict.sindonews.net/dyn/1280/salsabila/photo/2023/03/24/1/42671/tradisi-buka-puasa-bersama-di-masjid-qzt.jpg',
        'title' => 'Buka puasa bersama'
    ],
    [
        'image' => 'https://kkn.uad.ac.id/wp-content/uploads/2022/07/IMG_0170-1536x1024.jpg',
        'title' => 'Pengobatan gratis'
    ]
];

$faq = [
    [
        'question' => "Apa itu PeduliRasa?",
        'answer' => "PeduliRasa adalah platform yang menghubungkan pemilik makanan berlebih dengan mereka yang membutuhkan, bertujuan untuk mengurangi kelaparan dan pemborosan makanan di Indonesia."
    ],
    [
        'question' => "Bagaimana cara membagikan makanan?",
        'answer' => "Setelah mendaftar, Anda dapat mengunggah informasi tentang makanan yang ingin dibagikan melalui platform kami. Kami akan menghubungkan Anda dengan penerima yang membutuhkan."
    ],
    [
        'question' => "Bagaimana cara mendaftar di PeduliRasa?",
        'answer' => "Anda dapat mendaftar dengan mengunjungi halaman pendaftaran di website kami, mengisi formulir yang disediakan, dan mengikuti langkah-langkah yang ditentukan."
    ],
    [
        'question' => "Siapa yang dapat menggunakan PeduliRasa?",
        'answer' => "PeduliRasa terbuka untuk semua orang! Baik individu, komunitas, maupun organisasi yang ingin berbagi makanan atau menerima makanan."
    ],
    [
        'question' => "Apa saja jenis makanan yang bisa dibagikan?",
        'answer' => "Kami menerima berbagai jenis makanan siap saji dan makanan yang masih layak konsumsi. Pastikan makanan tersebut dalam kondisi baik dan aman untuk dikonsumsi."
    ],
    [
        'question' => "Siapa yang bisa dihubungi untuk pertanyaan lebih lanjut?",
        'answer' => "Jika Anda memiliki pertanyaan lain, silakan hubungi tim dukungan kami melalui [alamat email] atau kunjungi halaman kontak kami. Anda dapat menyesuaikan pertanyaan dan jawaban sesuai dengan kebutuhan spesifik dari Anda."
    ]
];

?>

<section
        class="bg-[url('/images/backgrounds/bakti-sosial-background.jpg')] bg-cover bg-center bg-no-repeat section-padding-x text-light-base pt-32 pb-12 md:pt-48 md:pb-36 relative">
    <div class="container max-w-screen-lg relative z-20">
        <div class="text-center">
            <p class="normal-font-size">Tentang Kami</p>
            <h1 class="mb-4 header-font-size font-extrabold tracking-tight max-w-screen-md mx-auto leading-none">
                Kami menghubungkan pemilik makanan berlebih dengan mereka yang
                membutuhkan
            </h1>
            <p class="mb-8 normal-font-size font-normal max-w-screen-sm mx-auto">
                PeduliRasa membantu mengurangi kelaparan dan pemborosan makanan di
                Indonesia, sehingga setiap orang dapat berbagi dan mendapatkan manfaat
                dari makanan yang ada.
            </p>
        </div>
    </div>
    <div class="w-full h-full bg-gradient-to-b from-dark-base/50 to-transparent absolute z-10 top-0 left-0">
    </div>
    <div class="justify-between items-center gap-4 max-w-screen-sm absolute -bottom-10 left-1/2 transform -translate-x-1/2 z-20 hidden lg:flex">
        <?php foreach ($achievement as $item) : ?>
            <div class="flex flex-col justify-center gap-2 p-4 bg-green-base rounded-lg">
                <p class="text-sm font-bold card-title-font-size">
                    <?= $item["title"] ?>
                </p>
                <p class="normal-font-size"><?= $item["description"] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section id="achievements" class="section-padding-x pt-4 pb-4 md:pt-8 md:pb-8 bg-green-base block lg:hidden">
    <div class="container max-w-screen-lg">
        <div class="flex flex-wrap gap-4 md:gap-8 justify-between items-center">
            <?php foreach ($achievement as $item) : ?>
                <div class="text-light-base">
                    <p class="font-bold subheader-font-size"> <?= $item["title"] ?></p>
                    <p class="normal-font-size"><?= $item["description"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="section-padding-x pt-8 md:pt-16 pb-8 text-dark-base">
    <div class="container max-w-screen-lg">
        <div class="flex gap-4 md:gap-16 flex-justify flex-col items-center lg:flex-row">
            <div class="">
                <h2 class="sub-header-font-size font-extrabold mb-2">Misi Kita</h2>
                <p class="normal-font-size max-w-xl text-justify">
                    PeduliRasa lahir dari keinginan untuk mengatasi masalah kelaparan dan
                    pemborosan makanan di Indonesia. Kami percaya bahwa setiap makanan
                    yang berlebih dapat menjadi harapan bagi mereka yang membutuhkan.
                    Melalui platform berbasis web yang mudah diakses, kami menghubungkan
                    pemilik makanan berlebih dengan individu atau komunitas yang
                    memerlukan, menciptakan jembatan antara surplus dan kebutuhan.
                </p>
            </div>
            <div class="lg:inset-y-0 lg:right-0 lg:w-1/2 my-4">
                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full rounded-lg"
                     src="/images/backgrounds/visi-misi.webp" alt="visi misi"/>
            </div>
        </div>
    </div>
</section>
<section id="gallery" class="section-padding-x pt-8 pb-8 overflow-hidden">
    <div class="container max-w-screen-lg">
        <div class="mb-4 text-center">
            <h2 class="sub-header-font-size font-bold">Dokumentasi</h2>
            <p class="normal-font-size">
                Berikut adalah daftar dokumentasi yang pernah dilakukan melalui aplikasi
                ini
            </p>
        </div>
        <div class="swiper documentation-card">
            <div class="swiper-wrapper">
                <?php foreach ($gallery as $img) : ?>
                    <div class="swiper-slide max-w-[240px] sm:max-w-[360px] lg:max-w-[480px] shadow-md shadow-white-base">
                        <img src="<?= $img["image"] ?>" alt="<?= $img["title"] ?>"/>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<section class="pt-8 pb-8 section-padding-x" id="faq">
    <div class="container max-w-screen-lg">
        <div class="text-center mb-8">
            <h2 class="font-bold text-center sub-header-font-size">
                Pertanyaan yang Sering Diajukan
            </h2>
            <p class="normal-font-size">
                Berikut adalah daftar pertanyaan yang sering diajukan oleh pengguna kami
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 normal-font-size">
            <?php foreach ($faq as $index => $data) : ?>
                <div class="mb-4">
                    <h6 class="faq-item font-semibold flex items-center gap-2 cursor-pointer">
                        <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0ZM10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2ZM10 14C10.2652 14 10.5196 14.1054 10.7071 14.2929C10.8946 14.4804 11 14.7348 11 15C11 15.2652 10.8946 15.5196 10.7071 15.7071C10.5196 15.8946 10.2652 16 10 16C9.73478 16 9.48043 15.8946 9.29289 15.7071C9.10536 15.5196 9 15.2652 9 15C9 14.7348 9.10536 14.4804 9.29289 14.2929C9.48043 14.1054 9.73478 14 10 14ZM10 4.5C10.8423 4.50003 11.6583 4.79335 12.3078 5.3296C12.9573 5.86585 13.3998 6.61154 13.5593 7.43858C13.7188 8.26562 13.5853 9.12239 13.1818 9.86171C12.7783 10.601 12.1299 11.1768 11.348 11.49C11.2322 11.5326 11.1278 11.6014 11.043 11.691C10.999 11.741 10.992 11.805 10.993 11.871L11 12C10.9997 12.2549 10.9021 12.5 10.7272 12.6854C10.5522 12.8707 10.313 12.9822 10.0586 12.9972C9.80416 13.0121 9.55362 12.9293 9.35817 12.7657C9.16271 12.6021 9.0371 12.3701 9.007 12.117L9 12V11.75C9 10.597 9.93 9.905 10.604 9.634C10.8783 9.52446 11.1176 9.34227 11.2962 9.10699C11.4748 8.87171 11.5859 8.59222 11.6176 8.29856C11.6493 8.00489 11.6004 7.70813 11.4762 7.44014C11.352 7.17215 11.1571 6.94307 10.9125 6.77748C10.6679 6.61189 10.3829 6.51606 10.0879 6.50027C9.79295 6.48448 9.49927 6.54934 9.23839 6.68787C8.97752 6.8264 8.75931 7.03338 8.60719 7.28658C8.45508 7.53978 8.37481 7.82962 8.375 8.125C8.375 8.39022 8.26964 8.64457 8.08211 8.83211C7.89457 9.01964 7.64022 9.125 7.375 9.125C7.10978 9.125 6.85543 9.01964 6.66789 8.83211C6.48036 8.64457 6.375 8.39022 6.375 8.125C6.375 7.16359 6.75692 6.24156 7.43674 5.56174C8.11656 4.88192 9.03859 4.5 10 4.5Z"
                                  fill="#676767"/>
                        </svg>
                        <?= $data["question"] ?>
                    </h6>
                    <p id="answer-<?= $index ?>" class="hidden text-justify pl-7">
                        <?= $data["answer"] ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="pt-8 pb-8 section-padding-x" id="contact-us">
    <div class="container max-w-screen-lg">
        <h2 class="sub-header-font-size font-bold mb-4">Hubungi Kami</h2>
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 w-full">
                <p class="normal-font-size">
                    We're here to assist you! If you have any questions or need
                    assistance, please feel free to reach out to us. You can also email us
                    at
                    <a href="mailto:contact@example.com" class="font-semibold border-b-4 border-green-400">
                        contact@example.com
                    </a>
                </p>
                <p class="normal-font-size mt-2">Connect with us on social media:</p>
                <span class="inline-flex mt-2 justify-center sm:justify-start">
                <a class="text-gray-500 hover:text-gray-900" target="_blank" href="https://twitter.com/example">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6"
                 viewBox="0 0 24 24">
              <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
              </path>
            </svg>
          </a>
          <a class="ml-3 text-gray-500 hover:text-gray-900" href="https://www.instagram.com/example/" target="_blank" >
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
              <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"
              ></path>
            </svg>
          </a>
          <a class="ml-3 text-gray-500 hover:text-gray-900" href="https://www.instagram.com/example/" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 512 512" fill="currentColor">
              <path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z">
              </path>
            </svg>
          </a>
        </span>
            </div>
            <div class="md:w-2/3 w-full md:pl-28">
                <form action="" method="post" id="submit-contact-form">
                    <div class="w-full">
                        <div class="relative">
                            <label for="name" class="text-dark-base normal-font-size font-semibold">
                                Your Name
                            </label>
                            <input type="text" id="name" name="name" required="" placeholder="Masukkan nama..." class="w-full bg-white rounded border border-gray-400 outline-none py-2 px-3"/>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="relative">
                            <label for="email" class="text-dark-base normal-font-size font-semibold">
                                Your Email
                            </label>
                            <input type="email" id="email" name="email" required="" placeholder="Masukkan email..." class="w-full bg-white rounded border border-gray-400 outline-none py-2 px-3" />
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="relative">
                            <label for="message" class="text-dark-base normal-font-size font-semibold">
                                Your Message
                            </label>
                            <textarea id="message" name="message" required="" placeholder="Masukkan pesan..." class="w-full bg-white rounded border border-gray-400 outline-none py-2 px-3 h-32">
                            </textarea>
                        </div>
                    </div>
                    <div class="w-full">
                        <button type="submit" class="flex text-light-base bg-green-base py-3 px-5 focus:outline-none rounded normal-font-size font-bold shadow-lg flex-col text-center">
                            Send Message ✉
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .swipper {
        width: 100%;
        padding: 50px 0;
    }

    .documentation-card {
        overflow: visible;
    }

    @media screen and (max-width: 1080px) {
        .documentation-card {
            overflow: hidden;
        }
    }

    .swiper-slide {
        position: relative;
        aspect-ratio: 16/10;
        border-radius: 14px;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: inherit;
        user-select: none;
    }
</style>

<script>
    let documentationSwiper = new Swiper(".documentation-card", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        initialSlide: 2,
        speed: 600,
        preventClicks: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 0,
            stretch: 80,
            depth: 350,
            modifier: 1,
            slideShadows: true,
        },
        on: {
            click(params) {
                documentationSwiper.slideTo(params.clickedIndex);
            },
        },
    });
</script>
<script>
    const toggleAnswer = (index) => {
        const answer = document.getElementById(`answer-${index}`);
        answer.classList.toggle("hidden");
    };

    document.addEventListener("DOMContentLoaded", () => {
        const faqItems = document.querySelectorAll(".faq-item");
        faqItems.forEach((faq, index) => {
            faq.addEventListener("click", () => toggleAnswer(index));
        });
    });
</script>