<?php


namespace App\Services;

use App\Repositories\Eloquent\DiscountRepository;

class DiscountService
{
    /**
     * @var DiscountRepository
     */
    private $discoutRepository;

    public function __construct()
    {
        $this->discoutRepository = new DiscountRepository();
    }

    public function getClientDiscountsByPhone($phone)
    {
        return $this->discoutRepository->getClientDiscountsByPhone($phone);
    }
}
