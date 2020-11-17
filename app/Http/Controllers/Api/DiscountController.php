<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * @var DiscountService
     */
    private $discountService;

    public function __construct()
    {
        $this->discountService = new DiscountService();
    }
}
