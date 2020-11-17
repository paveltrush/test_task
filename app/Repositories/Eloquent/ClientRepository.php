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

    public function getClientDiscountsByPhone($phone)
    {
        return $this->model->where('personal_phone', '=', $phone)
            ->leftJoin('client_discount', 'client_discount.client_id', '=', 'clients.id', function ($query) {
                return $query->select('id', 'date_activation as date');
            })
            ->get();
    }

    public function getDiscountsById($client_id)
    {
        return $this->model->where('clients.id', '=', $client_id)
            ->join('client_discount', function ($query) {
                $query->on('client_discount.client_id', '=', 'clients.id');
            })
            //->selectSub('client_discount.id', 'client_discount.date_activation')
            ->get();
    }


}
