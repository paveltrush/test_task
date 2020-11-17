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

    public function getDiscounts($discount_id = null)
    {
        if(empty($discount_id)){
            return $this->discoutRepository->getAll();
        }

        return $this->discoutRepository->getById($discount_id);
    }
}
