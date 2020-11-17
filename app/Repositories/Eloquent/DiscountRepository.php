<?php


namespace App\Repositories\Eloquent;


use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;

class DiscountRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Discount());
    }

    public function getClientDiscountsByPhone(string $phone)
    {
        return '';
    }
}
