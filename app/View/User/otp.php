<?php

?>


<section
        id="otp-code"
        class="pt-28 md:pt-28 lg:pt-20 pb-16 lg:pb-0 normal-font-size"
>
    <!-- component -->
    <div class="flex justify-center items-center">
        <!-- Left: Image -->
        <div class="w-1/2 h-screen hidden lg:block">
            <img
                    src="/images/backgrounds/visi-misi.webp"
                    alt="Placeholder Image"
                    class="object-cover w-full h-full rounded-r-3xl"
            />
        </div>
        <!-- Right: Login Form -->
        <div
                class="lg:p-24 lg:pt-8 px-4 w-full lg:w-1/2 flex justify-center items-center"
        >
            <div class="max-w-md w-full">
                <h1 class="header-font-size font-bold mb-2">Verifikasi OTP</h1>
                <p class="mb-4">
                    Kami mengrim kode OTP untuk Verifikasi, silahkan masukan kode yang
                    kami kirim
                </p>
                <!-- hasil -->
                <form action="#" method="POST" class="max-w-md mx-auto" id="inputOTP">
                    <div
                            class="flex flex-row items-center justify-between mx-auto w-full max-w-md my-4"
                    >
                        <div class="w-16 h-16 md:w-20 md:h-20">
                            <input
                                    class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-base"
                                    type="text"
                                    name=""
                                    id=""
                            />
                        </div>
                        <div class="w-16 h-16 md:w-20 md:h-20">
                            <input
                                    class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-base"
                                    type="text"
                                    name=""
                                    id=""
                            />
                        </div>
                        <div class="w-16 h-16 md:w-20 md:h-20">
                            <input
                                    class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-base"
                                    type="text"
                                    name=""
                                    id=""
                            />
                        </div>
                        <div class="w-16 h-16 md:w-20 md:h-20">
                            <input
                                    class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-base"
                                    type="text"
                                    name=""
                                    id=""
                            />
                        </div>
                    </div>
                    <div class="flex flex-col space-y-5">
                        <div>
                            <a
                                    href="/login"
                                    class="flex flex-row items-center justify-center text-center w-full border rounded-xl outline-none py-4 bg-blue-base border-none text-white shadow-sm"
                            >
                                Verifikasi Akun
                            </a>
                        </div>
                        <div
                                class="flex flex-row items-center justify-center font-medium space-x-1"
                        >
                            <p>Tidak menerima kode?</p>
                            <a
                                    class="flex flex-row items-center text-blue-base font-semibold"
                                    href=""
                                    target="_blank"
                                    rel="noopener noreferrer">Kirim ulang kode</a
                            >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
