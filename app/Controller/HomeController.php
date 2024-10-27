<?php

namespace PeduliRasa\Controller;

use PeduliRasa\App\Flasher;
use PeduliRasa\App\View;
use PeduliRasa\Config\Database;
use PeduliRasa\Exception\ValidationException;
use PeduliRasa\Model\GetPostRequest;
use PeduliRasa\Model\GetPostUserRequest;
use PeduliRasa\Model\SearchPostRequest;
use PeduliRasa\Model\UserDeletePostRequest;
use PeduliRasa\Model\UserUpdatePostRequest;
use PeduliRasa\Model\UserUploadPostRequest;
use PeduliRasa\Repository\CategoryRepository;
use PeduliRasa\Repository\PostImagesRepository;
use PeduliRasa\Repository\PostRepository;
use PeduliRasa\Repository\SessionRepository;
use PeduliRasa\Repository\UserRepository;
use PeduliRasa\Service\PostService;
use PeduliRasa\Service\SessionService;
use PeduliRasa\Service\UserService;

class HomeController
{

    private SessionService $sessionService;
    private PostService $postService;
    private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $postRepository = new PostRepository($connection);
        $categoryRepository = new CategoryRepository($connection);
        $postImagesRepository = new PostImagesRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->postService = new PostService($postRepository, $categoryRepository, $postImagesRepository, $userRepository);

        $this->userService = new UserService($userRepository);
    }

    function index(): void
    {
        $user = $this->sessionService->current();

        $model = [
            "title" => "Beranda",
        ];

        if ($user != null) {
            $model["user"] = [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "profilePhoto" => $user->profilePhoto,
            ];
        }

        // Ambil data makanan dan minuman (kategori 1, 2, 3)
        $foodAndDrinkRequest = new SearchPostRequest();
        $foodAndDrinkRequest->categories = [1, 2, 3];
        $foodAndDrinkRequest->page = 1;
        $foodAndDrink = $this->postService->search($foodAndDrinkRequest)->posts;

        // Ambil data kegiatan (kategori 4, 5, 6)
        $activityRequest = new SearchPostRequest();
        $activityRequest->categories = [4, 5, 6];
        $activityRequest->page = 1;
        $activity = $this->postService->search($activityRequest)->posts;

        // Set hasil pencarian ke model
        $model["foodAndDrink"] = $foodAndDrink;
        $model["activity"] = $activity;

        // Render view
        View::render('Home/index', model: $model);
    }


    function upload(): void
    {
        $user = $this->sessionService->current();

        $model = [
            "title" => "Ayo Berbagi",
        ];
        if ($user != null) {
            $model["user"] = [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "profilePhoto" => $user->profilePhoto,
            ];
        }

        View::render('Home/upload', model: $model);
    }

    function postUpload(): void
    {
        $user = $this->sessionService->current();

        $request = new UserUploadPostRequest();
        $request->title = $_POST["title"];
        $request->description = $_POST["description"];
        $request->location = $_POST["location"];
        $request->postDate = new \DateTime($_POST["postDate"]);
        $request->categoryId = $_POST["categoryId"];
        $request->userId = $user->id;

        // Menangkap file upload dari $_FILES, misalnya dari input "photos[]"
        if (isset($_FILES['photos'])) {
            $request->photos = $_FILES['photos'];
        } else {
            $request->photos = [];
        }

        try {
            // Panggil service upload postingan
            $this->postService->upload($request);

            Flasher::setFlash("Berhasil", "Postingan berhasil diupload");
            View::redirect("/");
        } catch (ValidationException $err) {
            Flasher::setFlash("Error", $err->getMessage(), "danger");
            View::redirect('/ayo-berbagi');
        }
    }

    public function update($postId): void
    {
        $user = $this->sessionService->current();
        $model = [
            "title" => "Update Postingan",
            $model["user"] = [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "profilePhoto" => $user->profilePhoto,
            ]
        ];

        $req = new GetPostRequest();
        $req->postId = (int) $postId;

        try {
            // Ambil post dan gambar dari service
            $res = $this->postService->getPost($req);
            // Jika post ditemukan, cek apakah user yang mengakses adalah pemilik post
            if ($res->post->userId !== $user->id) {
                Flasher::setFlash("Maaf", "Anda tidak diizinkan untuk memperbarui pos ini. Silahkan masuk terlebih dahulu", "danger");
                View::redirect('/');
                return;
            }

            // Isi model dengan data post dan gambar
            $model["post"] = [
                "id" => $res->post->id,
                "title" => $res->post->title,
                "description" => $res->post->description,
                "location" => $res->post->location,
                "postDate" => $res->post->postDate->format('Y-m-d H:i:s'),
                "categoryId" => $res->post->categoryId,
                "userId" => $res->post->userId,
                "images" => $res->images,
            ];

            // Render view untuk halaman update
            View::render('Home/update', $model);
        } catch (ValidationException $exception) {
            Flasher::setFlash("Maaf", $exception->getMessage(), "danger");
            View::redirect('/');
        }
    }

    function postUpdate(): void
    {
        $user = $this->sessionService->current();

        $req = new UserUpdatePostRequest();
        $req->postId = $_POST["postId"];
        $req->title = $_POST["title"];
        $req->description = $_POST["description"];
        $req->location = $_POST["location"];
        $req->postDate = new \DateTime($_POST["postDate"]);
        $req->categoryId = $_POST["categoryId"];
        $req->userEmail = $user->email;

        try {
            $this->postService->update($req);
            Flasher::setFlash("Berhasil", "Postingan berhasil diubah");
            View::redirect("/profile/manage-posts");
        } catch (ValidationException $err) {
            Flasher::setFlash("Error", $err->getMessage(), "danger");
            View::redirect('/post/update/' . $req->postId);
        }
    }

    function postDelete(): void
    {
        $user = $this->sessionService->current();

        $req = new UserDeletePostRequest();
        $req->postId = $_POST["postId"];
        $req->userEmail = $user->email;

        try {
            $this->postService->delete($req);
            Flasher::setFlash("Berhasil", "Postingan berhasil dihapus");
            View::redirect("/profile/manage-posts");
        } catch (ValidationException $exception) {
            Flasher::setFlash("Error", $exception->getMessage(), "danger");
            View::redirect('/');
        }
    }
    function search(): void
    {
        $user = $this->sessionService->current();

        $model = [
            "title" => "Cari Postingan",
        ];

        if ($user != null) {
            $model["user"] = [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "profilePhoto" => $user->profilePhoto,
            ];
        }

        // Ambil parameter pencarian dari request
        $request = new SearchPostRequest();
        $request->title = $_GET['title'] ?? null;

        // Konversi string '1,2,3' menjadi array [1, 2, 3]
        if (!empty($_GET['categories'])) {
            $request->categories = array_map('intval', explode(',', $_GET['categories']));
        } else {
            $request->categories = [];
        }

        $request->page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        try {
            $response = $this->postService->search($request);

            $model["posts"] = $response->posts;

            View::render('Home/search', model: $model);
        } catch (ValidationException $e) {
            Flasher::setFlash("Maaf", $e->getMessage(), "danger");
            View::redirect('/');
        }
    }


    function detail($id): void
    {
        $user = $this->sessionService->current();
        $model = [
            "title" => "Detail Postingan",
        ];
        if ($user != null) {
            $model["user"] = [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "profilePhoto" => $user->profilePhoto,
                "phoneNumber" => $user->phoneNumber
            ];
        }

        $req = new GetPostRequest();
        $req->postId = $id;

        try {
            $res = $this->postService->getPost($req);
            $postUser = $this->userService->findUser($res->post->userId);
            $model["post"] = [
                "id" => $res->post->id,
                "title" => $res->post->title,
                "description" => $res->post->description,
                "location" => $res->post->location,
                "postDate" => $res->post->postDate->format('Y-m-d H:i:s'),
                "category" => $res->category,
                "createdAt" => $res->post->timeStamp,
                "user" => $postUser,
                "images" => $res->images,
            ];

            View::render('Home/detail', model: $model);
        } catch (ValidationException $exception) {
            Flasher::setFlash("Maaf", $exception->getMessage(), "danger");
            View::redirect('/');
            return;
        }
    }

    function about (){
        $user = $this->sessionService->current();

        $model = [
            "title" => "Tentang Kami",
        ];

        if ($user != null) {
            $model["user"] = [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "profilePhoto" => $user->profilePhoto,
                "phoneNumber" => $user->phoneNumber
            ];
        }

        View::render("Home/about", model: $model);
    }


    public function manage ():void {
        $user = $this->sessionService->current();

        $model = [
            "title" => "Kelola Postingan",
        ];

        if ($user != null) {
            $model["user"] = [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "profilePhoto" => $user->profilePhoto,
                "phoneNumber" => $user->phoneNumber
            ];
        }

        $request = new GetPostUserRequest();
        $request->userId = $user->id;
        $request->page = $_GET['page'] ?? 1;

        $response = $this->postService->findByUserId($request);

        $model["posts"] = $response->posts;

        View::render('Home/manage-posts', model: $model);
    }

}