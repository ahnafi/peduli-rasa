<?php

namespace PeduliRasa\Service;

use PeduliRasa\Config\Database;
use PeduliRasa\Domain\Post;
use PeduliRasa\Domain\PostImage;
use PeduliRasa\Exception\ValidationException;
use PeduliRasa\Model\GetPostRequest;
use PeduliRasa\Model\GetPostResponse;
use PeduliRasa\Model\GetPostUserRequest;
use PeduliRasa\Model\GetPostUserResponse;
use PeduliRasa\Model\SearchPostRequest;
use PeduliRasa\Model\SearchPostResponse;
use PeduliRasa\Model\UserDeletePostRequest;
use PeduliRasa\Model\UserUpdatePostRequest;
use PeduliRasa\Model\UserUpdatePostResponse;
use PeduliRasa\Model\UserUploadPostRequest;
use PeduliRasa\Repository\CategoryRepository;
use PeduliRasa\Repository\PostImagesRepository;
use PeduliRasa\Repository\PostRepository;
use PeduliRasa\Repository\UserRepository;

class PostService
{

    private PostRepository $postRepository;
    private CategoryRepository $categoryRepository;
    private PostImagesRepository $postImagesRepository;
    private UserRepository $userRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, PostImagesRepository $postImagesRepository, UserRepository $userRepository)
    {
        $this->postImagesRepository = $postImagesRepository;
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }


    public function upload(UserUploadPostRequest $request): void
    {
        // Validate the incoming request
        $this->ValidateUserUploadPostRequest($request);

        try {
            Database::beginTransaction();

            // Check if the category exists
            $category = $this->categoryRepository->find($request->categoryId);
            if ($category === null) {
                throw new ValidationException("Kategori tidak ditemukan");
            }

            // Create and save the post
            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->postDate = $request->postDate;
            $post->location = $request->location;
            $post->userId = $request->userId;
            $post->categoryId = $request->categoryId;

            $post = $this->postRepository->save($post);

            if (!empty($request->photos)) {
                $uploadDir = __DIR__ . "/../../public/images/posts/";

                foreach ($request->photos["tmp_name"] as $index => $tmp) {

                    $extension = pathinfo($request->photos["name"][$index], PATHINFO_EXTENSION);
                    $imgNames = uniqid() . "." . $extension;

                    if (move_uploaded_file($tmp, $uploadDir . $imgNames)) {
                        $postImage = new PostImage();
                        $postImage->postId = $post->id;
                        $postImage->imageName = $imgNames;
                        $this->postImagesRepository->save($postImage);
                    }
                }
            }
            Database::commitTransaction();
        } catch (\Exception $e) {
            Database::rollbackTransaction();
            throw $e;
        }
    }

    private function ValidateUserUploadPostRequest(UserUploadPostRequest $request): void
    {
        // Validasi title
        if ($request->title == null || trim($request->title) === '') {
            throw new ValidationException("Judul diperlukan");
        }

        // Validasi description
        if ($request->description == null || trim($request->description) === '') {
            throw new ValidationException("Deskripsi diperlukan");
        }

        // Validasi postDate
        if ($request->postDate == null) {
            throw new ValidationException("Tanggal posting diperlukan");
        }

        // Validasi location
        if ($request->location == null || trim($request->location) === '') {
            throw new ValidationException("Lokasi diperlukan");
        }

        // Validasi categoryId
        if ($request->categoryId == null || $request->categoryId <= 0) {
            throw new ValidationException("Kategori yang valid diperlukan");
        }

        // Validasi photos (file upload)
        if ($request->photos == null || count($request->photos) === 0) {
            throw new ValidationException("Setidaknya satu foto diperlukan");
        }

        foreach ($request->photos["error"] as $err) {
            if ($err !== UPLOAD_ERR_OK) {
                throw new ValidationException("Kesalahan mengunggah file");
            }
        }

        foreach ($request->photos["type"] as $file) {
            $validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($file, $validTypes)) {
                throw new ValidationException("Jenis file tidak valid");
            }
        }

        foreach ($request->photos["size"] as $file) {
            $maxSize = 1024 * 1024;
            if ($file > $maxSize) {
                throw new ValidationException("Ukuran file terlalu besar, ukuran maksimum adalah 1MB");
            }
        }
    }

    public function getPost(GetPostRequest $request): GetPostResponse
    {
        $this->ValidateGetPostRequest($request);

        $post = $this->postRepository->findById($request->postId);

        if ($post == null) {
            throw new ValidationException("Postingan tidak ditemukan");
        }

        $category = $this->categoryRepository->find($post->categoryId);

        $images = $this->postImagesRepository->findByPostId($post->id);

        $response = new GetPostResponse();
        $response->post = $post;
        $response->images = $images;
        $response->category = $category->name;

        return $response;
    }

    private function ValidateGetPostRequest(GetPostRequest $request): void
    {
        if ($request->postId == null || trim($request->postId) === '') {
            throw new ValidationException("ID postingan diperlukan");
        }
    }


    public function update(UserUpdatePostRequest $request): UserUpdatePostResponse
    {
        $this->ValidateUserUpdatePostRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findUserByField("email", $request->userEmail);

            if ($user == null) {
                throw new ValidationException("Pengguna tidak ditemukan");
            }

            $post = $this->postRepository->findById($request->postId);

            if ($post == null) {
                throw new ValidationException("Postingan tidak ditemukan");
            }

            if ($post->userId != $user->id) {
                throw new ValidationException("Pengguna tidak diizinkan untuk memperbarui postingan");
            }

            $post->title = $request->title;
            $post->description = $request->description;
            $post->postDate = $request->postDate;
            $post->location = $request->location;
            $post->categoryId = $request->categoryId;

            $post = $this->postRepository->update($post);

            $images = $this->postImagesRepository->findByPostId($post->id);

            $response = new UserUpdatePostResponse();
            $response->post = $post;
            $response->images = $images;
            Database::commitTransaction();
            return $response;
        } catch (\Exception $e) {
            Database::rollbackTransaction();
            throw $e;
        }
    }

    private function ValidateUserUpdatePostRequest(UserUpdatePostRequest $request): void
    {
        if ($request->postId == null || trim($request->postId) === '') {
            throw new ValidationException("ID postingan diperlukan");
        }

        if ($request->title == null || trim($request->title) === '') {
            throw new ValidationException("Judul diperlukan");
        }

        if ($request->description == null || trim($request->description) === '') {
            throw new ValidationException("Deskripsi diperlukan");
        }

        if ($request->postDate == null) {
            throw new ValidationException("Tanggal posting diperlukan");
        }

        if ($request->location == null || trim($request->location) === '') {
            throw new ValidationException("Lokasi diperlukan");
        }

        if ($request->categoryId == null) {
            throw new ValidationException("ID kategori diperlukan");
        }

        if ($request->userEmail == null || trim($request->userEmail) === '') {
            throw new ValidationException("Anda harus login terlebih dahulu");
        }
    }

    public function delete(UserDeletePostRequest $request): void
    {
        $this->ValidateDeletePostRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findUserByField("email", $request->userEmail);
            if ($user == null) {
                throw new ValidationException("Pengguna tidak ditemukan");
            }

            $post = $this->postRepository->findById($request->postId);
            if ($post == null) {
                throw new ValidationException("Postingan tidak ditemukan");
            }

            if ($post->userId != $user->id) {
                throw new ValidationException("Pengguna tidak diizinkan untuk menghapus postingan ini");
            }

            $images = $this->postImagesRepository->findByPostId($post->id);
            $dirFile = __DIR__ . "/../../public/images/posts/";

            foreach ($images as $image) {
                $pathImage = $dirFile . $image->imageName;

                if (file_exists($pathImage)) {
                    unlink($pathImage);
                }

                $this->postImagesRepository->delete($image->id);
            }

            $this->postRepository->delete($post->id);

            Database::commitTransaction();
        } catch (\Exception $e) {
            Database::rollbackTransaction();
            throw $e;
        }
    }

    private function ValidateDeletePostRequest(UserDeletePostRequest $request): void
    {
        if ($request->postId == null || trim($request->postId) === '') {
            throw new ValidationException("ID postingan diperlukan");
        }

        if ($request->userEmail == null || trim($request->userEmail) === '') {
            throw new ValidationException("Email pengguna diperlukan");
        }
    }

    public function search(SearchPostRequest $request): SearchPostResponse
    {
        $this->ValidateSearchPostRequest($request);

        try {
            $posts = $this->postRepository->search(
                $request->title,
                $request->categories,
                $request->page
            );

            foreach ($posts as $post) {
                $images = $this->postImagesRepository->findByPostId($post->id);

                if (!empty($images)) {
                    $post->bannerImage = $images[0]->imageName;
                } else {
                    $post->bannerImage = null;
                }
            }

            $res = new SearchPostResponse();
            $res->posts = $posts;

            return $res;
        } catch (\Exception $e) {
            throw $e;
        }
    }


    private function ValidateSearchPostRequest(SearchPostRequest $request): void
    {
        if ($request->title == null && empty($request->categories)) {
            throw new ValidationException("Judul atau Kategori diperlukan");
        }
    }

    public function findByUserId(GetPostUserRequest $request): GetPostUserResponse
    {

        if ($request->userId == null) {
            throw new ValidationException("ID pengguna diperlukan");
        }

        try {

            $user = $this->userRepository->findUserByField("user_id", $request->userId);
            if ($user == null) {
                throw new ValidationException("Pengguna tidak ditemukan");
            }

            $posts = $this->postRepository->findByUser($user->id, $request->page);

            foreach ($posts as $post) {
                $images = $this->postImagesRepository->findByPostId($post->id);

                if (!empty($images)) {
                    $post->bannerImage = $images[0]->imageName;
                } else {
                    $post->bannerImage = null;
                }
            }

            $response = new GetPostUserResponse();
            $response->posts = $posts;

            return $response;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
