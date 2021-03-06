<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientController extends TestCase
{
    /**
     * Method checks if route not found.
     *
     * @return void
     */
    public function testGetAccountUsersNotFound()
    {
        $data = ['date_from' => '26.06.2019', 'date_to' => '27.06.2019'];

        $this->json('POST', '/api/GetUsers', $data)
            ->assertStatus(404);
    }

    /**
     * Method supposed to return successfully result with not empty value
     *
     * @return void
     */
    public function testGetAccountUsersSuccessfullyIfNotEmptyResult()
    {
        $dateFrom = Client::min('date_register');
        $dateTo = Client::max('date_register');

        $data = ['date_from' => $dateFrom, 'date_to' => $dateTo];

        $this->json('POST', '/api/matrix/GetAccountUsers', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'first_name',
                        'second_name',
                        'last_name',
                        'date_register',
                        'last_login',
                        'personal_mobile',
                        'personal_phone',
                        'discounts'
                    ]
                ]
            ]);
    }


    /**
     * Method supposed to return successfully result with empty value
     *
     * @return void
     */
    public function testGetAccountUsersSuccessfullyIfEmptyResult()
    {
        $data = ['date_from' => '26.06.2019', 'date_to' => '27.06.2019'];

        $this->json('POST', '/api/GetAccountUsers', $data)
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
    public function testGetAccountDiscountsByPhoneNotFound()
    {
        $data = ['user_phone' => '72942958613'];

        $this->json('POST', '/api/GetAccountDiscountsPhone', $data)
            ->assertStatus(404);
    }

    /**
     * Method supposed to return successfully result with not empty data
     *
     * @return void
     */
    public function testGetAccountDiscountsByPhoneSuccessfullyIfNotEmptyResult()
    {
        $user_phone = Client::firstOrFail('personal_phone');

        $data = ['user_phone' => $user_phone];

        $this->json('POST', '/api/GetAccountDiscountsByPhone', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'first_name',
                        'second_name',
                        'last_name',
                        'date_register',
                        'last_login',
                        'personal_mobile',
                        'personal_phone',
                        'discounts'
                    ]
                ]
            ]);
    }


    /**
     * Method supposed to return successfully result with empty value.
     *
     * @return void
     */
    public function testGetAccountDiscountsByPhoneIfEmptyResult()
    {
        $data = ['user_phone' => '70000000000'];

        $this->json('POST', '/api/GetAccountDiscountsByPhone', $data)
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
    public function testGetAccountDiscountNotFound()
    {
        $data = ['user_id' => null];

        $this->json('POST', '/api/GetAccountDiscountByClient', $data)
            ->assertStatus(404);
    }

    /**
     * Method supposed to return successfully result with not empty data.
     *
     * @return void
     */
    public function testGetAccountDiscountsIfNotEmptyResult()
    {
        $user_id = Client::first('id');

        $data = ['user_id' => $user_id];

        $this->json('POST', '/api/GetAccountDiscounts', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'first_name',
                        'second_name',
                        'last_name',
                        'date_register',
                        'last_login',
                        'personal_mobile',
                        'personal_phone',
                        'discounts'
                    ]
                ]
            ]);
    }


    /**
     * Method supposed to return successfully result with empty value.
     *
     * @return void
     */
    public function testGetAccountDiscountsIfEmptyResult()
    {
        $data = ['user_id' => null];

        $this->json('POST', '/api/GetAccountDiscounts', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => []
            ]);
    }

}
