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

    /**
     * DiscountController constructor.
     */
    public function __construct()
    {
        $this->discountService = new DiscountService();
    }

    /**
     * Method returns a list of discounts that will end in the coming days.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExpiringDiscounts(Request $request)
    {
        $days = $request->get('days');

        $expiringDiscounts = $this->discountService->getExpiringDiscounts($days)->toArray();

        return $this->sendResponse($expiringDiscounts);
    }

    /**
     * Method displays a list of all discounts in the personal account.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllDiscounts(Request $request)
    {
        $discount_id = $request->get('discount_id');

        $discounts = $this->discountService->getDiscounts($discount_id)->toArray();

        return $this->sendResponse($discounts);
    }
}
