<?php

namespace PeduliRasa\Controller;

use PeduliRasa\App\Flasher;
use PeduliRasa\App\View;
use PeduliRasa\Config\Database;
use PeduliRasa\Exception\ValidationException;
use PeduliRasa\Model\UserLoginRequest;
use PeduliRasa\Model\UserPasswordUpdateRequest;
use PeduliRasa\Model\UserProfileUpdateRequest;
use PeduliRasa\Model\UserRegisterRequest;
use PeduliRasa\Repository\SessionRepository;
use PeduliRasa\Repository\UserRepository;
use PeduliRasa\Service\SessionService;
use PeduliRasa\Service\UserService;

class UserController
{
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function register(): void
    {
        View::render('User/register', [
            'title' => 'Register new User'
        ]);
    }

    public function postRegister(): void
    {
        $request = new UserRegisterRequest();
        $request->email = $_POST['email'];
        $request->username = $_POST['username'];
        $request->phoneNumber = $_POST['phoneNumber'];
        $request->password = $_POST['password'];

        try {
            $this->userService->register($request);
            View::redirect('/login');
        } catch (ValidationException $exception) {
            Flasher::setFlash('ups', $exception->getMessage(), "error");
            View::redirect('/register');
        }
    }

    public function login(): void
    {
        View::render('User/login', [
            "title" => "Login user"
        ]);
    }

    public function postLogin(): void
    {
        $request = new UserLoginRequest();
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->login($request);
            $this->sessionService->create($response->user->id);
            View::redirect('/');
        } catch (ValidationException $exception) {
            Flasher::setFlash('danger', $exception->getMessage(), "danger");
            View::redirect('/login');
        }
    }

    public function logout(): void
    {
        $this->sessionService->destroy();
        View::redirect("/");
    }

    public function updateProfile(): void
    {
        $user = $this->sessionService->current();

        View::render('User/profile', [
            "title" => "Update user profile",
            "user" => [
                "id" => $user->id,
                "email" => $user->email,
                "username" => $user->username,
                "phoneNumber" => $user->phoneNumber,
                "profilePhoto" => $user->profilePhoto
            ],
        ]);
    }

    public function postUpdateProfile(): void
    {
        $user = $this->sessionService->current();

        $request = new UserProfileUpdateRequest();
        $request->email = $user->email;
        $request->username = $_POST['username'];
        $request->phoneNumber = $_POST['phoneNumber'];

        // Tangkap file upload dari $_FILES
        if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] == UPLOAD_ERR_OK) {
            $request->profilePhoto = $_FILES['profilePhoto'];
        } else {
            $request->profilePhoto = null; // Jika tidak ada file yang di-upload
        }

        try {
            $this->userService->updateProfile($request);
            Flasher::setFlash('success', "Profile berhasil diupdate");
            View::redirect('/profile');
        } catch (ValidationException $exception) {
            Flasher::setFlash('danger', $exception->getMessage(), "danger");
            View::render('User/profile', [
                "title" => "Update user profile",
                "user" => [
                    "id" => $user->id,
                    "email" => $user->email,
                    "profilePhoto" => $user->profilePhoto,
                    "username" => $_POST['username'],
                    "phoneNumber" => $_POST['phoneNumber'],
                ]
            ]);
        }
    }


    public function updatePassword(): void
    {
        $user = $this->sessionService->current();
        View::render('User/password', [
            "title" => "Update user password",
            "user" => [
                "id" => $user->id,
                "email" => $user->email,
                "username" => $user->username,
                "phoneNumber" => $user->phoneNumber,
                "profilePhoto" => $user->profilePhoto
            ]
        ]);
    }

    public function postUpdatePassword(): void
    {
        $user = $this->sessionService->current();
        $request = new UserPasswordUpdateRequest();
        $request->email = $user->email;
        $request->oldPassword = $_POST['oldPassword'];
        $request->newPassword = $_POST['newPassword'];

        try {
            $this->userService->updatePassword($request);
            Flasher::setFlash('success', "Password berhasil diupdate");
            View::redirect('/');
        } catch (ValidationException $exception) {
            Flasher::setFlash('danger', $exception->getMessage(), "danger");
            View::render('User/password', [
                "title" => "Update user password",
                "user" => [
                    "id" => $user->id,
                    "email" => $user->email,
                    "username" => $user->username,
                    "phoneNumber" => $user->phoneNumber,
                    "profilePhoto" => $user->profilePhoto
                ]
            ]);
        }
    }
}