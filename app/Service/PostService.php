<?php

namespace PeduliRasa\Service;

use PeduliRasa\Config\Database;
use PeduliRasa\Domain\Post;
use PeduliRasa\Domain\PostImage;
use PeduliRasa\Exception\ValidationException;
use PeduliRasa\Model\GetPostRequest;
use PeduliRasa\Model\GetPostResponse;
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
        $this->ValidateUserUploadPostRequest($request);

        try {
            Database::beginTransaction();

            // Pengecekan apakah kategori ada atau tidak
            $category = $this->categoryRepository->find($request->categoryId);
            if ($category == null) {
                throw new ValidationException("Category not found");
            }

            // Simpan postingan dulu agar mendapatkan id post
            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->postDate = $request->postDate;
            $post->location = $request->location;
            $post->userId = $request->userId;
            $post->categoryId = $request->categoryId;

            $post = $this->postRepository->save($post); // Simpan posting dan dapatkan id

            // Proses setiap foto dalam array photos
            if ($request->photos !== null && count($request->photos) > 0) {
                $uploadDir = __DIR__ . "/../../public/images/posts/";

                foreach ($request->photos as $photo) {
                    // Validasi dan simpan file foto
                    $photoName = uniqid() . '-' . basename($photo['name']);
                    $photoPath = $uploadDir . $photoName;

                    if (move_uploaded_file($photo['tmp_name'], $photoPath)) {
                        // Simpan nama file tiap foto ke database
                        $postImage = new PostImage();
                        $postImage->postId = $post->id;
                        $postImage->imageName = $photoName;

                        $this->postImagesRepository->save($postImage);
                    } else {
                        throw new ValidationException("Failed to upload image: " . $photo['name']);
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
            throw new ValidationException("Title is required");
        }

        // Validasi description
        if ($request->description == null || trim($request->description) === '') {
            throw new ValidationException("Description is required");
        }

        // Validasi postDate
        if ($request->postDate == null) {
            throw new ValidationException("Post date is required");
        }

        // Validasi location
        if ($request->location == null || trim($request->location) === '') {
            throw new ValidationException("Location is required");
        }

        // Validasi categoryId
        if ($request->categoryId == null || $request->categoryId <= 0) {
            throw new ValidationException("Valid category is required");
        }

        // Validasi photos (file upload)
        if ($request->photos == null || count($request->photos) === 0) {
            throw new ValidationException("At least one photo is required");
        }

        // Validasi tiap file foto
        foreach ($request->photos as $photo) {
            if ($photo['error'] !== UPLOAD_ERR_OK) {
                throw new ValidationException("Error uploading file: " . $photo['name']);
            }

            // Validasi tipe file (hanya izinkan jpg, png, jpeg)
            $validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($photo['type'], $validTypes)) {
                throw new ValidationException("Invalid file type for image: " . $photo['name']);
            }

            // Validasi ukuran file (misalnya maksimum 5MB)
            $maxSize = 1 * 1024 * 1024; // 1MB
            if ($photo['size'] > $maxSize) {
                throw new ValidationException("File size exceeds limit for image: " . $photo['name']);
            }
        }
    }

    public function getPost(GetPostRequest $request): GetPostResponse
    {
        // Validasi request
        $this->ValidateGetPostRequest($request);

        // Ambil post berdasarkan postId
        $post = $this->postRepository->findById($request->postId);

        // Jika post tidak ditemukan, lempar error
        if ($post == null) {
            throw new ValidationException("Post not found");
        }

        // Ambil semua image yang berhubungan dengan post
        $images = $this->postImagesRepository->findByPostId($post->id);

        // Buat response
        $response = new GetPostResponse();
        $response->post = $post;
        $response->images = $images;

        return $response;
    }

    private function ValidateGetPostRequest(GetPostRequest $request): void
    {
        if ($request->postId == null || trim($request->postId) === '') {
            throw new ValidationException("Post ID is required");
        }
    }


    public function update(UserUpdatePostRequest $request): UserUpdatePostResponse
    {
        $this->ValidateUserUpdatePostRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findUserByField("email", $request->userEmail);

            if ($user == null) {
                throw new ValidationException("User not found");
            }

            $post = $this->postRepository->findById($request->postId);

            if ($post == null) {
                throw new ValidationException("Post not found");
            }

            if ($post->userId != $user->id) {
                throw new ValidationException("User not allowed to update post");
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
            throw new ValidationException("Post ID is required");
        }

        if ($request->title == null || trim($request->title) === '') {
            throw new ValidationException("Title is required");
        }

        if ($request->description == null || trim($request->description) === '') {
            throw new ValidationException("Description is required");
        }

        if ($request->postDate == null) {
            throw new ValidationException("Post date is required");
        }

        if ($request->location == null || trim($request->location) === '') {
            throw new ValidationException("Location is required");
        }

        if ($request->categoryId == null) {
            throw new ValidationException("Category ID is required");
        }

        if ($request->userEmail == null || trim($request->userEmail) === '') {
            throw new ValidationException("anda harus login terlebih dahulu");
        }
    }

    public function delete(UserDeletePostRequest $request):void {
        $this->ValidateDeletePostRequest($request);

        try{
            Database::beginTransaction();

            $user = $this->userRepository->findUserByField("email", $request->userEmail);

            if ($user == null) {
                throw new ValidationException("User not found");
            }

            $post = $this->postRepository->findById($request->postId);

            if ($post == null) {
                throw new ValidationException("Post not found");
            }

            if($post->userId != $user->id){
                throw new ValidationException("User not allowed to delete post");
            }

            $this->postRepository->delete($post->id);

            Database::commitTransaction();
        }catch (\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    private function ValidateDeletePostRequest(UserDeletePostRequest $request): void
    {
        if($request->postId == null || trim($request->postId) === '' || $request->userEmail == null || trim($request->userEmail) === ''){
            throw new ValidationException("Post ID and user Email is required");
        }
    }
}