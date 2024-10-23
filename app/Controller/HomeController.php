<?php

namespace PeduliRasa\Controller;

use PeduliRasa\App\Flasher;
use PeduliRasa\App\View;
use PeduliRasa\Config\Database;
use PeduliRasa\Exception\ValidationException;
use PeduliRasa\Repository\SessionRepository;
use PeduliRasa\Repository\UserRepository;
use PeduliRasa\Service\SessionService;

class HomeController
{

    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
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

    function postUpload():void{
        $user = $this->sessionService->current();

        try {
//            service upload postingan

            Flasher::setFlash("success","Postingan Berhasil diupload");
            View::redirect("/");
        }catch (ValidationException $err){
            Flasher::setFlash("danger",$err->getMessage(),"danger");
            View::redirect('Home/upload');
        }

    }

    function postDelete():void{

    }

    function search():void{

    }

    function detail($id):void{

    }

}