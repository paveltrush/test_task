<?php


namespace App\Repositories\Eloquent;


use App\Models\Discount;

class DiscountRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Discount());
    }

    public function getByExpiringDays($days)
    {
        $now = now()->format('Y-m-d');

        return $this->model->whereBetween('date_active_to', [$now, $days])
            ->with('clients:id')
            ->get();
    }
}
