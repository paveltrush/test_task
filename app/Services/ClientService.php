<?php


namespace App\Services;


use App\Repositories\Eloquent\ClientRepository;

class ClientService
{

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * ClientService constructor.
     */
    public function __construct()
    {
        $this->clientRepository = new ClientRepository();
    }

    /**
     * Method formats dates and call repository.
     * @param $date_from
     * @param $date_to
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getClientByRegisterPeriod($date_from, $date_to)
    {
        $date_from = date('Y-m-d H:i:s', strtotime($date_from));
        $date_to = date('Y-m-d H:i:s', strtotime($date_to));

        return $this->clientRepository->getByRegisterInterval($date_from, $date_to);
    }

    /**
     * Method gets client information by phone via repository.
     * @param $phone
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getClientDiscountsByPhone($phone)
    {
        return $this->clientRepository->getClientDiscountsByPhone($phone);
    }

    /**
     * Method gets client information by client id via repository.
     * @param $client_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getClientDiscountsByClient($client_id)
    {
        return $this->clientRepository->getDiscountsById($client_id);
    }
}
