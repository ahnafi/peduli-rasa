<?php

namespace PeduliRasa\Controller;

use PeduliRasa\App\Flasher;
use PeduliRasa\App\View;
use PeduliRasa\Config\Database;
use PeduliRasa\Exception\ValidationException;
use PeduliRasa\Model\UserUpdatePostRequest;
use PeduliRasa\Model\UserUploadPostRequest;
use PeduliRasa\Repository\CategoryRepository;
use PeduliRasa\Repository\PostImagesRepository;
use PeduliRasa\Repository\PostRepository;
use PeduliRasa\Repository\SessionRepository;
use PeduliRasa\Repository\UserRepository;
use PeduliRasa\Service\PostService;
use PeduliRasa\Service\SessionService;

class HomeController
{

    private SessionService $sessionService;
    private PostService $postService;

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
        $this->postService = new PostService($postRepository,$categoryRepository,$postImagesRepository,$userRepository);
    }

    function index() : void
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
            ];
        }

        View::render('Home/index', model: $model);
    }

    function upload():void{
        $user = $this->sessionService->current();

        $model = [
            "title" => "Ayo Berbagi",
        ];
        if ($user != null) {
            $model["user"] = [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
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

            // Notifikasi sukses dan redirect
            Flasher::setFlash("success", "Postingan berhasil diupload");
            View::redirect("/");
        } catch (ValidationException $err) {
            // Notifikasi error dan redirect ke halaman upload lagi
            Flasher::setFlash("danger", $err->getMessage(), "danger");
            View::redirect('Home/upload');
        }
    }

    function update($postId):void{
        $user = $this->sessionService->current();
        $model = [
            "title" => "Update Postingan",
        ];

        if ($user != null) {
            $model["user"] = [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
            ];
        }

        try {
        $req = new UserUpdatePostRequest();
        $req->userEmail = $user->email;
        $req->postId = $postId;

        $res = $this->postService->getPostUpdate($req);

        $model["post"] = [
            "id" => $res->post->id,
            "title" => $res->post->title,
            "description" => $res->post->description,
            "location" => $res->post->location,
            "postDate" => $res->post->postDate,
            "categoryId" => $res->post->categoryId,
            "userId" => $res->post->userId,
            "images" => $res->images,
        ];

        View::render('Home/update', model: $model);
        }catch (ValidationException $err) {
            Flasher::setFlash("danger", $err->getMessage(), "danger");
            View::redirect('/');
        }
    }

    function postUpdate(): void{
        $user = $this->sessionService->current();

        try {



        }catch (ValidationException $err) {
            Flasher::setFlash("danger", $err->getMessage(), "danger");
            View::redirect('/');
        }

    }

    function postDelete():void{

    }

    function search():void{

    }

    function detail($id):void{

    }

}