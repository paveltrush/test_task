<?php


namespace App\Repositories\Eloquent;


use App\Models\Client;

class ClientRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Client());
    }

    public function getByRegisterInterval($date_from, $date_to)
    {
        return $this->model->whereBetween('date_register', [$date_from, $date_to])
            ->with('discounts')
            ->get();
    }


}
