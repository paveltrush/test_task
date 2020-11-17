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

    public function getExpiringDiscounts($days)
    {
        $days = now()->addDays($days)->format('Y-m-d');

        return $this->discoutRepository->getByExpiringDays($days);
    }
}
