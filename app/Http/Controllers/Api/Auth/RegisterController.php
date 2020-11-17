<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $userService = new UserService();

        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');

        $userService->store($name, $email, $password);

        return $this->sendResponse([], "You are registered successfully");
    }
}
