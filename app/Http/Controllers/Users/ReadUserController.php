<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Api\Serializers\Users\UserSerializer;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class ReadUserController extends Controller
{
    public function __construct(
        private readonly UserSerializer $serializer,
        private readonly UsersModel $model
    ) {

    }

    /**
     * @throws HttpException
     */
    public function __invoke(string $uuid) : JsonResponse
    {
        if (!Uuid::isValid($uuid)) {
            throw new HttpException(400, 'Invalid UUID');
        }

        $uuidObj = Uuid::fromString($uuid);

        try {
            $user = $this->model->findByUuid($uuidObj);
        } catch (UserNotFoundException $e) {
            throw new HttpException(404, sprintf('User not found "%s"', $uuid), $e);
        }

        return new JsonResponse(
            $this->serializer->serialize($user),
            201
        );
    }
}
