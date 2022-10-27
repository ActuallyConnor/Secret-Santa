<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTeamController extends Controller
{
    public function __invoke(Request $request) : JsonResponse
    {
        return new JsonResponse([], 201);
    }
}
