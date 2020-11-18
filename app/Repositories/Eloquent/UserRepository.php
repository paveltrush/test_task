<?php


namespace App\Repositories\Eloquent;


use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new User());
    }

    /**
     * Storing user data.
     * @param string $name
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function store(string $name, string $email, string $password):bool
    {
        $this->model->name = $name;
        $this->model->email = $email;
        $this->model->password = $password;

        return $this->save();
    }
}
