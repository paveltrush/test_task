<?php


namespace App\Repositories\Eloquent;


use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository extends BaseRepository
{
    /**
     * ClientRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new Client());
    }

    /**
     * Get all user accounts with discounts at a given interval.
     * @param $date_from
     * @param $date_to
     * @return
     */
    public function getByRegisterInterval($date_from, $date_to): Collection
    {
        return $this->model->whereBetween('date_register', [$date_from, $date_to])
            ->with('clientDiscounts')
            ->get();
    }

    /**
     * Get all user accounts with discounts by phone.
     * @param $phone
     * @return
     */
    public function getClientDiscountsByPhone($phone): Collection
    {
        return $this->model->where('personal_phone', '=', $phone)
            ->with('clientDiscounts')
            ->get();
    }

    /**
     * Get user account with discounts by user id.
     * @param $id
     * @return
     */
    public function getDiscountsById($id): Collection
    {
        return $this->model->where('id', '=', $id)
            ->with('clientDiscounts')
            ->get();
    }


}
