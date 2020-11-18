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

    /**
     * ClientController constructor.
     */
    public function __construct()
    {
        $this->clientService = new ClientService();
    }

    /**
     * Method returns registered customers for a period of time.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAccountUsers(Request $request)
    {
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');

        $clients = $this->clientService->getClientByRegisterPeriod($date_from, $date_to);

        return $this->sendResponse($clients);
    }

    /**
     * Method returns all active customer discounts by client phone.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAccountDiscountsByPhone(Request $request)
    {
        $phone = $request->get('user_phone');

        $clientDiscounts = $this->clientService->getClientDiscountsByPhone($phone);

        return $this->sendResponse($clientDiscounts);
    }

    /**
     * Method returns all active customer discounts.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAccountDiscounts(Request $request)
    {
        $client_id = $request->get('user_id');

        $clientDiscounts = $this->clientService->getClientDiscountsByClient($client_id);

        return $this->sendResponse($clientDiscounts);
    }
}
