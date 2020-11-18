<?php


namespace App\Repositories\Eloquent;


use App\Models\Discount;
use Illuminate\Database\Eloquent\Collection;

class DiscountRepository extends BaseRepository
{
    /**
     * DiscountRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new Discount());
    }

    /**
     * Get discounts with clients id by expiring days.
     * @param $days
     * @return Collection
     */
    public function getByExpiringDays($days): Collection
    {
        $now = now()->format('Y-m-d');

        return $this->model->whereBetween('date_active_to', [$now, $days])
            ->with('clients:id')
            ->get();
    }

    /**
     * Get discounts by discount id.
     * @param $id
     * @return Collection
     */
    public function getById($id): Collection
    {
        return $this->model->find($id);
    }

    /**
     * Get all available discounts.
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }
}
