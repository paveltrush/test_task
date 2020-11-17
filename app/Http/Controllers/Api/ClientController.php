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

        $clients = $this->clientService->getClientByRegisterPeriod($date_from,$date_to);

        return $this->sendResponse($clients);
    }
}