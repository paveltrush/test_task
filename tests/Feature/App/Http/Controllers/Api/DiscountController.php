<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiscountController extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetExpiringDiscountsNotFound()
    {
        $data = ['days' => 5];

        $this->json('GET', '/api/GetExpiringDiscounts', $data)
            ->assertStatus(404);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetExpiringDiscountsSuccessfullyIfNotEmptyResult()
    {
        $dateTo = Discount::max('date_active_to');
        $dateFormatted = Carbon::createFromDate($dateTo);

        $days = $dateFormatted->diffInDays(now());

        $data = ['days' => $days];

        $this->json('GET', '/api/GetExpiringDiscounts', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'code',
                        'name',
                        'discount',
                        'date_active_from',
                        'date_active_to',
                        'project_id',
                        'preview_text',
                        'users'
                    ]
                ]
            ]);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetExpiringDiscountsSuccessfullyIfEmptyResult()
    {
        $data = ['days' => 0];

        $this->json('GET', '/api/GetExpiringDiscounts', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => []
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function testGetAccountUsersNotFound()
//    {
//        $data = ['date_from' => '26.06.2019', 'date_to' => '27.06.2019'];
//
//        $this->json('GET', '/api/GetUsers', $data)
//            ->assertStatus(404);
//    }
//
//    /**
//     * A basic feature test example.
//     *
//     * @return void
//     */
//    public function testGetAccountUsersSuccessfullyIfNotEmptyResult()
//    {
//        $dateFrom = Client::min('date_register');
//        $dateTo = Client::max('date_register');
//
//        $data = ['date_from' => $dateFrom, 'date_to' => $dateTo];
//
//        $this->json('GET', '/api/GetAccountUsers', $data)
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                'data' => [
//                    [
//                        'id',
//                        'first_name',
//                        'second_name',
//                        'last_name',
//                        'date_register',
//                        'last_login',
//                        'personal_mobile',
//                        'personal_phone',
//                        'discounts'
//                    ]
//                ]
//            ]);
//    }
//
//
//    /**
//     * A basic feature test example.
//     *
//     * @return void
//     */
//    public function testGetAccountUsersSuccessfullyIfEmptyResult()
//    {
//        $data = ['date_from' => '26.06.2019', 'date_to' => '27.06.2019'];
//
//        $this->json('GET', '/api/GetAccountUsers', $data)
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                'data' => []
//            ]);
//    }
}
