<section id="register" class="pt-28 md:pt-28 lg:pt-14 pb-16 lg:pb-0 normal-font-size">
    <div class="flex justify-center items-center">
        <!-- Left: Image -->
        <div class="w-1/2 h-screen hidden lg:block">
            <img src="/images/backgrounds/visi-misi.webp" alt="Placeholder Image"
                 class="object-cover w-full h-full rounded-r-3xl"/>
        </div>
        <!-- Right: Login Form -->
        <div class="lg:p-24 lg:pt-8 px-4 w-full lg:w-1/2 flex justify-center items-center">
            <div class="max-w-md w-full">
                <h1 class="header-font-size font-bold mb-2">Daftar</h1>
                <p class="mb-4">
                    Sudah punya akun?
                    <a href="/login" class="text-blue-base font-semibold">Masuk</a>
                </p>
                <form action="/register" method="POST" id="formRegister" onsubmit="return validateForm()">
                    <!-- Username Input -->
                    <div class="mb-2">
                        <label for="username" class="block text-black font-medium">Nama Lengkap</label>
                        <input type="text"
                               id="username"
                               name="username"
                               class="w-full border border-gray-300 rounded-md py-2 px-3 md:py-3 md:px-4 focus:outline-none focus:border-blue-500"
                               autocomplete="off"
                               required
                               placeholder="Masukan nama lengkap..."
                        />
                    </div>
                    <!-- Email Input -->
                    <div class="mb-2">
                        <label for="email" class="block text-black font-medium">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="w-full border border-gray-300 rounded-md py-2 px-3 md:py-3 md:px-4 focus:outline-none focus:border-blue-500"
                               autocomplete="off"
                               required
                               placeholder="Masukan email..."
                        />
                    </div>
                    <!-- Phone Number Input -->
                    <div class="mb-2">
                        <label for="phoneNumber" class="block text-black font-medium">Nomor Telepon</label>
                        <input type="text"
                               id="phoneNumber"
                               name="phoneNumber"
                               class="w-full border border-gray-300 rounded-md py-2 px-3 md:py-3 md:px-4 focus:outline-none focus:border-blue-500"
                               autocomplete="off"
                               required
                               placeholder="Masukan nomor telepon..."
                        />
                    </div>
                    <!-- Password Input -->
                    <div class="mb-2">
                        <label for="password" class="block text-black font-medium">Password</label>
                        <input type="password"
                               id="password"
                               name="password"
                               class="w-full border border-gray-300 rounded-md py-2 px-3 md:py-3 md:px-4 focus:outline-none focus:border-blue-500"
                               autocomplete="off"
                               required
                               placeholder="Masukan password..."
                        />
                    </div>
                    <!-- Password Verification Input -->
                    <div class="mb-2">
                        <label for="passwordVerification" class="block text-black font-medium">Verifikasi Password</label>
                        <input type="password"
                               id="passwordVerification"
                               name="passwordVerification"
                               class="w-full border border-gray-300 rounded-md py-2 px-3 md:py-3 md:px-4 focus:outline-none focus:border-blue-500"
                               autocomplete="off"
                               required
                               placeholder="Verifikasi password..."
                        />
                    </div>
                    <!-- Checkbox -->
                    <div class="flex mb-2">
                        <div class="flex items-center">
                            <input type="checkbox" id="rememberMe" name="rememberMe"/>
                            <label for="rememberMe" class="ml-2"> Ingatkan saya</label>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit"
                            class="block mb-2 bg-blue-base text-white font-semibold rounded-md py-2 px-4 w-full text-center">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function validateForm() {
        let password = document.getElementById("password").value;
        let verif = document.getElementById("passwordVerification").value;
        let phoneNumber = document.getElementById("phoneNumber").value;

        // Validasi password minimal 8 karakter
        if (password.length < 8) {
            Swal.fire("Password harus terdiri dari minimal 8 karakter.");
            return false;
        }

        // Verifikasi password cocok
        if (password !== verif) {
            Swal.fire("Password tidak cocok!");
            return false;
        }

        // Validasi nomor telepon dan ubah format ke +62
        if (phoneNumber.startsWith("08")) {
            document.getElementById("phoneNumber").value = phoneNumber.replace(/^08/, "+62");
        }

        return true;
    }
</script>
