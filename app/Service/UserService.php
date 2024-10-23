<?php

namespace PeduliRasa\Service;

use Exception;
use PeduliRasa\Config\Database;
use PeduliRasa\Domain\User;
use PeduliRasa\Exception\ValidationException;
use PeduliRasa\Model\UserLoginRequest;
use PeduliRasa\Model\UserLoginResponse;
use PeduliRasa\Model\UserPasswordUpdateRequest;
use PeduliRasa\Model\UserPasswordUpdateResponse;
use PeduliRasa\Model\UserProfileUpdateRequest;
use PeduliRasa\Model\UserProfileUpdateResponse;
use PeduliRasa\Model\UserRegisterRequest;
use PeduliRasa\Model\UserRegisterResponse;
use PeduliRasa\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findUserByField("email", $request->email);
            if ($user != null) {
                throw new ValidationException("User Id already exists");
            }

            $user = new User();
            $user->email = $request->email;
            $user->username = $request->username;
            $user->phoneNumber = $request->phoneNumber;
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);

            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserRegistrationRequest(UserRegisterRequest $request): void
    {
        if ($request->email == null || $request->username == null || $request->password == null || $request->phoneNumber == null ||
            trim($request->email) == "" || trim($request->username) == "" || trim($request->password) == "" || trim($request->phoneNumber) == "") {
            throw new ValidationException("Email, Nama Lengkap ,Nomor Telepon dan Password tidak boleh kosong");
        }
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findUserByField("email", $request->email);
        if ($user == null) {
            throw new ValidationException("Email atau Password Salah");
        }

        if (password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("Email atau Password Salah");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request): void
    {
        if ($request->email == null || $request->password == null ||
            trim($request->email) == "" || trim($request->password) == "") {
            throw new ValidationException("Email, Password tidak boleh kosong");
        }
    }

    public function updateProfile(UserProfileUpdateRequest $request): UserProfileUpdateResponse
    {
        $this->validateUserProfileUpdateRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findUserByField("email", $request->email);
            if ($user == null) {
                throw new ValidationException("User tidak ditemukan");
            }

            $user->username = $request->username;
            $user->phoneNumber = $request->phoneNumber;

            // Menghandle upload file
            if ($request->profilePhoto && isset($request->profilePhoto['tmp_name'])) {
                $pathPhoto = __DIR__ . "/../../public/images/profile/";
                $extension = pathinfo($request->profilePhoto['name'], PATHINFO_EXTENSION);
                $namePhoto = uniqid() . '.' . $extension; // Nama unik untuk file gambar

                // Pindahkan file yang di-upload ke direktori yang telah ditentukan
                move_uploaded_file($request->profilePhoto['tmp_name'], $pathPhoto . $namePhoto);

                // Update nama file di entitas user
                $user->profilePhoto = $namePhoto;
            }

            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserProfileUpdateResponse();
            $response->user = $user;
            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserProfileUpdateRequest(UserProfileUpdateRequest $request):void
    {
        if ($request->email == null || $request->username == null || $request->phoneNumber == null ||
            trim($request->email) == "" || trim($request->username) == "" || trim($request->phoneNumber) == "") {
            throw new ValidationException("Email, Username, dan Phone Number tidak boleh kosong");
        }

        if ($request->profilePhoto && $request->profilePhoto['error'] == UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($request->profilePhoto['type'], $allowedTypes)) {
                throw new ValidationException("Tipe file gambar tidak valid");
            }
            if ($request->profilePhoto['size'] > 2 * 1024 * 1024) { // Maksimal 2MB
                throw new ValidationException("Ukuran file gambar terlalu besar");
            }
        }
    }

    public function updatePassword(UserPasswordUpdateRequest $request): UserPasswordUpdateResponse
    {
        $this->validateUserPasswordUpdateRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findUserByField("email",$request->email);
            if ($user == null) {
                throw new ValidationException("User tidak ditemukan");
            }

            if (!password_verify($request->oldPassword, $user->password)) {
                throw new ValidationException("Password lama salah");
            }

            $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserPasswordUpdateResponse();
            $response->user = $user;
            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserPasswordUpdateRequest(UserPasswordUpdateRequest $request):void
    {
        if ($request->email == null || $request->oldPassword == null || $request->newPassword == null ||
            trim($request->email) == "" || trim($request->oldPassword) == "" || trim($request->newPassword) == "") {
            throw new ValidationException("Email atau Password tidak boleh kosong");
        }
    }
}