<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends BaseController
{
    /**
     * @var DiscountService
     */
    private $discountService;

    public function __construct()
    {
        $this->discountService = new DiscountService();
    }

    public function getExpiringDiscounts(Request $request)
    {
        $days = $request->get('days');

        $expiringDiscounts = $this->discountService->getExpiringDiscounts($days)->toArray();

        return $this->sendResponse($expiringDiscounts);
    }
}
