<?php
$title = $_Post["title"] ?? "";
$description = $_Post["description"] ?? "";
$location = $_Post["location"] ?? "";

?>

<section id="add-product" class="section-padding-x pt-24 pb-8 small-font-size">
    <div class="max-w-screen-xl container">
        <h1 class="font-bold sub-header-font-size mb-4">Buat Postingan</h1>
        <form action="/ayo-berbagi" method="post" enctype="multipart/form-data">
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="title" class="block mb-2 font-medium text-dark-base">
                        Nama
                    </label>
                    <input type="text" name="title" id="title"
                           class="bg-gray-50 border border-gray-300 text-dark-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                           placeholder="Masukkan nama makanan/minuman atau acara..." required value="<?= $title ?>"/>
                </div>
                <div>
                    <label for="postDate" class="block mb-2 font-medium text-dark-base">
                        Tanggal kedaluwarsa atau acara
                    </label>
                    <input type="datetime-local" name="postDate" id="postDate"
                           class="bg-gray-50 border border-gray-300 text-dark-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                           placeholder="Masukkan harga produk..." inputmode="numeric" required/>
                </div>
                <div>
                    <label for="location" class="block mb-2 font-medium text-dark-base">
                        Lokasi
                    </label>
                    <input type="text" name="location" id="location" value="<?= $location?>"
                           class="bg-gray-50 border border-gray-300 text-dark-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                           placeholder="Masukkan lokasi..." required/>
                </div>
                <div>
                    <label for="category" class="block mb-2 font-medium text-dark-base">
                        Kategori
                    </label>
                    <select id="category" name="categoryId"
                            class="bg-gray-50 border border-gray-300 text-dark-base rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                        <option value="0">Pilih Kategori</option>
                        <option value="1">Makanan Basah</option>
                        <option value="2">Makanan Kering</option>
                        <option value="3">Minuman</option>
                        <option value="4">Jumat Berkah</option>
                        <option value="5">Peduli Sosial</option>
                        <option value="6">Bakti Sosial</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 font-medium text-dark-base">Deskripsi</label>
                    <textarea id="description" rows="4" name="description"
                              class="block p-2.5 w-full text-dark-base bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" ><?= $description ?></textarea>
                </div>
                <div class="flex items-center justify-center w-full sm:col-span-2">
                    <label for="dropzone-file"
                       class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2">
                        </path>
                    </svg>
                    <span class="mb-2 text-gray-500">
                    <span class="font-semibold">Click to upload</span> or drag anddrop</span>
                    <span class="text-xs text-gray-500">
                    SVG, PNG, JPG or GIF (MAX. 800x400px)
                    </span>

                    <span id="file-count" class="mt-2 text-sm text-gray-500"></span>

                    <input id="dropzone-file" type="file" name="photos[]" class="hidden" multiple onchange="updateFileCount()"/>
                </label>
            </div>
            </div>
            <button type="submit" class="text-light-base bg-blue-base inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg px-5 py-2.5 text-center" >
                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                          clip-rule="evenodd">
                    </path>
                </svg>
                Ayo Bagikan
            </button>
        </form>
    </div>
</section>

<script>
    function updateFileCount() {
        const fileInput = document.getElementById('dropzone-file');
        const fileCountDisplay = document.getElementById('file-count');
        const count = fileInput.files.length;
        fileCountDisplay.textContent = count > 0 ? `${count} file(s) selected` : '';
    }
</script>
