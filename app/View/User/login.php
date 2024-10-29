<section id="login" class="pt-32 lg:pt-20 pb-16 lg:pb-0 normal-font-size">
    <div class="flex justify-center items-center flex-row-reverse">
        <!-- Left: Image -->
        <div class="w-1/2 h-screen hidden lg:block">
            <img src="/images/backgrounds/charity-foodbank-volunteer.jpg" alt="Login Image" class="object-cover w-full h-full rounded-l-3xl" />
        </div>
        <!-- Right: Login Form -->
        <div class="lg:p-24 lg:pt-8 px-4 w-full lg:w-1/2 flex justify-center items-center">
            <div class="w-full max-w-xl mx-auto">
                <h1 class="header-font-size font-bold mb-2">Masuk</h1>
                <p class="mb-4">
                    Belum punya akun? <a href="/register" class="text-blue-500">Daftar</a>
                </p>
                <form action="/login" method="POST" >
                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="block text-black font-medium">Email</label>
                        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required placeholder="Masukan email..." />
                    </div>
                    <!-- Password Input -->
                    <div class="mb-4">
                        <label for="password" class="block text-black font-medium">Password</label>
                        <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required placeholder="Masukan password..." />
                    </div>
                    <div class="flex mb-4">
                        <!-- Remember Me Checkbox -->
                        <div class="flex items-center">
                            <input type="checkbox" id="rememberMe" name="rememberMe" />
                            <label for="rememberMe" class="ml-2">Ingatkan saya</label>
                        </div>
                        <!-- Forgot Password Link -->
                        <div class="text-blue-500 ml-auto">
                            <a href="/login/forgot" class="hover:underline">Forgot Password?</a>
                        </div>
                    </div>
                    <!-- Login Button -->
                    <button type="submit" class="block mb-2 bg-blue-base text-white font-semibold rounded-md py-2 px-4 w-full text-center">Masuk</button>
                    <button type="button" class="flex items-center justify-center bg-white border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 focus:outline-none w-full">
                        <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 0 48 48">
                            <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Color-" transform="translate(-401.000000, -860.000000)">
                                    <g id="Google" transform="translate(401.000000, 860.000000)">
                                        <path d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24" id="Fill-1" fill="#FBBC05"></path>
                                        <path d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333" id="Fill-2" fill="#EB4335"></path>
                                        <path d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667" id="Fill-3" fill="#34A853"></path>
                                        <path d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24" id="Fill-4" fill="#4285F4"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span>Continue with Google</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
