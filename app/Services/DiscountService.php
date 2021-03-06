<?php


namespace App\Services;

use App\Repositories\Eloquent\DiscountRepository;

class DiscountService
{
    /**
     * @var DiscountRepository
     */
    private $discoutRepository;

    /**
     * ClientService constructor.
     */
    public function __construct()
    {
        $this->discoutRepository = new DiscountRepository();
    }

    /**
     * Method formats received days and calls repository method.
     * @param $days
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getExpiringDiscounts($days)
    {
        $days = now()->addDays($days)->format('Y-m-d');

        return $this->discoutRepository->getByExpiringDays($days);
    }

    /**
     * The method returns all discounts if id is not specified and returns the specified discount otherwise.
     * @param null $discount_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDiscounts($discount_id = null)
    {
        if(empty($discount_id)){
            return $this->discoutRepository->getAll();
        }

        return $this->discoutRepository->getById($discount_id);
    }
}
