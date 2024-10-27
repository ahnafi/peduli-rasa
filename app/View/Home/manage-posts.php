<?php
$posts = $model["posts"] ?? [];
?>

<div id="popup-modal" tabindex="-1"
     class="hidden fixed inset-0 z-[900] flex justify-center items-center bg-black bg-opacity-50 normal-font-size">
    <div class="relative bg-white rounded-lg shadow p-4 md:p-6">
        <button type="button" id="close-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-900">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        <div class="text-center max-w-md">

            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12"
                 aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 20 20">

                <path stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
            </svg>
            <h3 class="mb-5 font-normal text-gray-500">
                Apakah Anda yakin ingin menghapus postingan ini?
            </h3>
            <button id="confirm-delete"
                    class="text-white bg-red-600 hover:bg-red-800 px-5 py-2.5 rounded-lg">
                Ya
            </button>
            <button id="cancel-delete"
                    class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100">
                Tidak
            </button>
        </div>
    </div>
</div>
<div class="pt-24 pb-8 section-padding-x min-h-[480px] md:min-h-[640px]">
    <div class="container max-w-screen-xl">
        <div class="flex flex-col md:flex-row gap-8">
            <button
                    id="asideToggle"
                    class="block md:hidden p-3 bg-blue-base text-white font-semibold top-20 left-0 rounded-r-lg transform transition-transform fixed z-[800]"
            >
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"
                        class="w-5 h-5"
                        fill="currentColor"
                >
                    <path
                            d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"
                    ></path>
                </svg
                >
            </button>

            <!-- Aside -->
            <aside id="asideMenu"
                   class="fixed top-16 pt-4 md:pt-0 left-0 h-full w-64 bg-white transform -translate-x-full transition-transform md:w-1/3 lg:w-1/4 md:translate-x-0 md:static md:block pr-8 border-r border-indigo-100 z-50">
                <div class="sticky flex flex-col gap-2 text-sm">
                    <h2 class="pl-3 mb-4 text-2xl font-semibold">Pengaturan</h2>
                    <a href="/profile" class="flex items-center px-3 py-2.5 font-semibold">
                        Pengaturan Akun
                    </a>
                    <a href="/profile/manage-posts" class="flex items-center px-3 py-2.5 font-semibold">
                        Kelola Postingan
                    </a>
                    <a href="/logout"
                       class="flex items-center px-3 py-2.5 font-semibold bg-red-600 text-light-base rounded-lg">
                        Keluar
                    </a>
                </div>
            </aside>

            <div class="md:w-2/3 lg:w-3/4">
                <h1 class="sub-header-font-size font-semibold text-dark-base mb-4">
                    Kelola Postingan
                </h1>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-between">
                    <?php foreach ($posts as $post) : ?>
                        <div class="max-w-[300px] aspect-square bg-white border border-gray-200 rounded-lg shadow relative">
                            <div class="absolute top-1 right-1 md:top-2 md:right-2 flex gap-2 items-center z-10">
                                <a href="/post/update/<?= $post->id ?>"
                                   class="text-light-base bg-blue-base p-3 rounded-full edit-product">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 512 512"
                                         class="w-3 md:w-4"
                                         fill="currentColor">
                                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                    </svg>
                                </a>
                                <form action="/post/delete" method="post" onsubmit="return 1">
                                    <input type="hidden" name="postId" value="<?= $post->id ?>" >
                                    <button type="submit"
                                            class="cursor-pointer text-light-base bg-red-600 p-3 rounded-full delete-product">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-3 md:w-4"
                                             fill="currentColor">
                                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <a href="/post/detail/<?= $post->id ?>">
                                <img class="rounded-t-lg object-cover w-full max-h-[200px] aspect-square"
                                     src="/images/posts/<?= $post->bannerImage ?>" alt="image <?= $post->title ?>"/>
                            </a>
                            <div class="p-3">
                                <p class="price-title-font-size text-gray-700 flex items-center gap-2 extra-small-font-size">
                                    <svg class="w-4 h-4 text-gray-700" viewBox="0 0 14 17" fill="currentColor"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.94515 0.953796C3.46182 0.953796 0.611816 3.8038 0.611816 7.28713C0.611816 11.5621 6.15348 16.3913 6.39098 16.6288C6.54932 16.708 6.78682 16.7871 6.94515 16.7871C7.10348 16.7871 7.34098 16.708 7.49932 16.6288C7.73682 16.3913 13.2785 11.5621 13.2785 7.28713C13.2785 3.8038 10.4285 0.953796 6.94515 0.953796ZM6.94515 14.9663C5.28265 13.383 2.19515 9.9788 2.19515 7.28713C2.19515 4.67463 4.33265 2.53713 6.94515 2.53713C9.55765 2.53713 11.6952 4.67463 11.6952 7.28713C11.6952 9.89963 8.60765 13.383 6.94515 14.9663ZM6.94515 4.12046C5.20348 4.12046 3.77848 5.54546 3.77848 7.28713C3.77848 9.0288 5.20348 10.4538 6.94515 10.4538C8.68682 10.4538 10.1118 9.0288 10.1118 7.28713C10.1118 5.54546 8.68682 4.12046 6.94515 4.12046ZM6.94515 8.87046C6.07432 8.87046 5.36182 8.15796 5.36182 7.28713C5.36182 6.4163 6.07432 5.7038 6.94515 5.7038C7.81598 5.7038 8.52848 6.4163 8.52848 7.28713C8.52848 8.15796 7.81598 8.87046 6.94515 8.87046Z"/>
                                    </svg>
                                    <span><?= $post->location ?></span>
                                </p>
                                <h5 class="card-title-font-size font-bold tracking-tight text-dark-base">
                                    <a href="/post/detail/<?= $post->id ?>">
                                        <?= $post->title ?>
                                    </a>
                                </h5>
                                <p class="description-card-font-size font-normal text-gray-700">
                                    <?= truncateText($post->description,36) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const deleteButtons = document.querySelectorAll(".delete-product");
        const modal = document.getElementById("popup-modal");
        const closeModal = document.getElementById("close-modal");
        const cancelButton = document.getElementById("cancel-delete");
        const confirmDelete = document.getElementById("confirm-delete");

        let productIdToDelete = null;

        // Show modal on delete button click
        deleteButtons.forEach((button) => {
            button.addEventListener("click", (event) => {
                productIdToDelete = event.target.dataset.productId;
                modal.classList.remove("hidden");
            });
        });

        // Close modal on cancel or close button
        const closeModalFunction = () => {
            modal.classList.add("hidden");
            productIdToDelete = null;
        };

        closeModal.addEventListener("click", closeModalFunction);
        cancelButton.addEventListener("click", closeModalFunction);

        // Handle confirm delete action
        confirmDelete.addEventListener("click", () => {
            if (productIdToDelete !== null) {
                console.log(`Deleting product with id: ${productIdToDelete}`);
                // Call your delete logic here...
            }
            closeModalFunction();
        });
    });
</script>
<!-- Script untuk mengontrol tampilan aside dan tombol -->
<script>
    const asideMenu = document.getElementById("asideMenu");
    const asideToggle = document.getElementById("asideToggle");

    asideToggle.addEventListener("click", () => {
        asideMenu.classList.toggle("-translate-x-full");
        asideToggle.classList.toggle("translate-x-64"); // Tombol juga bergeser sejauh 64 (sesuai dengan lebar aside)
    });
</script>