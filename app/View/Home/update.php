<?php
$title = $model["post"]["title"] ?? $_Post["title"] ?? "";
$description = $model["post"]["description"] ?? $_Post["description"] ?? "";
$location = $model["post"]["location"] ?? $_Post["location"] ?? "";
$category = $model["post"]["categoryId"] ?? $_Post["categoryId"] ?? "";
$postDate = $model["post"]["postDate"] ?? $_Post["postDate"] ?? "";

?>

<section id="add-product" class="section-padding-x pt-24 pb-8 small-font-size">
    <div class="max-w-screen-xl container">
        <h1 class="font-bold sub-header-font-size mb-4">Update Postingan</h1>
        <form action="/post/update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="postId" value="<?= $model["post"]["id"] ?? "" ?>">
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
                           placeholder="Masukkan harga produk..." inputmode="numeric" required value="<?= $postDate ?>"/>
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
                            class="bg-gray-50 border border-gray-300 text-dark-base rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                        <option >Select category</option>
                        <option value="1" <?= $category == "1" ? "selected" : "" ?> >Makanan Basah</option>
                        <option value="2" <?= $category == "2" ? "selected" : "" ?>>Makanan Kering</option>
                        <option value="3" <?= $category == "3" ? "selected" : "" ?>>Minuman</option>
                        <option value="4" <?= $category == "4" ? "selected" : "" ?>>Jumat Berkah</option>
                        <option value="5" <?= $category == "5" ? "selected" : "" ?>>Peduli Sosial</option>
                        <option value="6" <?= $category == "6" ? "selected" : "" ?>>Bakti Sosial</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 font-medium text-dark-base">Deskripsi</label>
                    <textarea id="description" rows="4" name="description"
                              class="block p-2.5 w-full text-dark-base bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" ><?= $description ?></textarea>
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
                Update
            </button>
        </form>
    </div>
</section>
