<?php


namespace App\Services;


use App\Repositories\Eloquent\ClientRepository;

class ClientService
{

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct()
    {
        $this->clientRepository = new ClientRepository();
    }

    public function getClientByRegisterPeriod($date_from, $date_to)
    {
        $date_from = date($date_from);
        $date_to = date($date_to);

        return $this->clientRepository->getByRegisterInterval($date_from, $date_to);
    }
}
