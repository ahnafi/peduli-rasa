<?php

namespace PeduliRasa\Service;

use PeduliRasa\Config\Database;
use PeduliRasa\Domain\Post;
use PeduliRasa\Domain\PostImage;
use PeduliRasa\Exception\ValidationException;
use PeduliRasa\Model\UserUploadPostRequest;
use PeduliRasa\Repository\CategoryRepository;
use PeduliRasa\Repository\PostImagesRepository;
use PeduliRasa\Repository\PostRepository;

class PostService
{

    private PostRepository $postRepository;
    private CategoryRepository $categoryRepository;
    private PostImagesRepository $postImagesRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, PostImagesRepository $postImagesRepository)
    {
        $this->postImagesRepository = $postImagesRepository;
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
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

}