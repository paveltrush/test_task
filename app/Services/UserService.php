<?php


namespace App\Services;


use App\Repositories\Eloquent\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function store(string $name, string $email, string $password):bool
    {
        return $this->userRepository->store($name, $email, $password);
    }
}
