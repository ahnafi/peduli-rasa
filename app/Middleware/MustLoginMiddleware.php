<?php

namespace PeduliRasa\Middleware;

use PeduliRasa\App\View;
use PeduliRasa\Config\Database;
use PeduliRasa\Repository\SessionRepository;
use PeduliRasa\Repository\UserRepository;
use PeduliRasa\Service\SessionService;

class MustLoginMiddleware implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    function before(): void
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::redirect('/login');
        }
    }
}
