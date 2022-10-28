<?php

namespace App\Http\Controllers;

use App\Api\Serializers\Users\UserSerializer;
use App\Models\UserModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    public function __construct(
        private readonly UserSerializer $serializer,
        private readonly UserModel $model
    ) {

    }

    public function __invoke(Request $request) : JsonResponse
    {
        // TODO: validate

        $this->serializer->deserialize(json_decode($request->getContent(), true));

        $user = $this->model->findByUuid();

        return new JsonResponse([], 201);
    }
}
