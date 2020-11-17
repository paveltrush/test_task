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
    public function testGetAllDiscountsNotFound()
    {
        $this->json('GET', '/api/GetUsers', null)
            ->assertStatus(404);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAllDiscountsWithEmptyParameterSuccessfully()
    {
        $this->json('GET', '/api/GetAllDiscounts', null)
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
    public function testGetAllDiscountsWithNotEmptyParameterSuccessfully()
    {
        $discountId = Discount::first('id');

        $data = ['discount_id' => $discountId];

        $this->json('GET', '/api/GetAllDiscounts', $data)
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
