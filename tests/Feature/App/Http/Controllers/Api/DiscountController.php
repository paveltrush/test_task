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
     * Method checks if route not found.
     *
     * @return void
     */
    public function testGetExpiringDiscountsNotFound()
    {
        $data = ['days' => 5];

        $this->json('POST', '/api/GetExpiringDiscounts', $data)
            ->assertStatus(404);
    }

    /**
     * Method supposed to return successfully result with not empty value.
     *
     * @return void
     */
    public function testGetExpiringDiscountsSuccessfullyIfNotEmptyResult()
    {
        $dateTo = Discount::max('date_active_to');
        $dateFormatted = Carbon::createFromDate($dateTo);

        $days = $dateFormatted->diffInDays(now());

        $data = ['days' => $days];

        $this->json('POST', '/api/GetExpiringDiscounts', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
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
            ]);
    }


    /**
     * Method supposed to return successfully result with empty value.
     *
     * @return void
     */
    public function testGetExpiringDiscountsSuccessfullyIfEmptyResult()
    {
        $data = ['days' => 0];

        $this->json('POST', '/api/GetExpiringDiscounts', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => []
            ]);
    }

    /**
     * Method checks if route not found.
     *
     * @return void
     */
    public function testGetAllDiscountsNotFound()
    {
        $this->json('POST', '/api/GetUsers', null)
            ->assertStatus(404);
    }

    /**
     *  Method checks the script to work when the value is empty.
     *
     * @return void
     */
    public function testGetAllDiscountsWithEmptyParameterSuccessfully()
    {
        $this->json('POST', '/api/GetAllDiscounts', null)
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
     * Method checks the script to work when the value is not empty.
     *
     * @return void
     */
    public function testGetAllDiscountsWithNotEmptyParameterSuccessfully()
    {
        $discountId = Discount::first('id');

        $data = ['discount_id' => $discountId];

        $this->json('POST', '/api/GetAllDiscounts', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
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
            ]);
    }
}
