<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Service\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return $this->sendResponse($this->service->getUsers(), 'Success');
    }
    public function store(Request $request)
    {
        $relationShip = $this->service->createRelationship($request->all());
        return $this->sendResponse($relationShip, 'Success');
    }
}
