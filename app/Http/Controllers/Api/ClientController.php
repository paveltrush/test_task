<?php

namespace App\Http\Controllers\Api;

use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends BaseController
{
    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct()
    {
        $this->clientService = new ClientService();
    }

    public function getAccountUsers(Request $request)
    {
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');

        $clients = $this->clientService->getClientByRegisterPeriod($date_from, $date_to);

        return $this->sendResponse($clients);
    }

    public function getAccountDiscountsByPhone(Request $request)
    {
        $phone = $request->get('user_phone');

        $clientDiscounts = $this->clientService->getClientDiscountsByPhone($phone);

        return $this->sendResponse($clientDiscounts);
    }

    public function getAccountDiscounts(Request $request)
    {
        $client_id = $request->get('user_id');

        $clientDiscounts = $this->clientService->getClientDiscountsByClient($client_id);

        return $this->sendResponse($clientDiscounts);
    }
}
