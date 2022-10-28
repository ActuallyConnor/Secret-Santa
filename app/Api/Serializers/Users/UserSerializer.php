<?php

declare(strict_types=1);

namespace App\Api\Serializers\Users;

use App\Domain\Users\User;

final class UserSerializer
{
    public function serialize(User $user) : array
    {
        $serialized = [];

        return $serialized;
    }

    public function deserialize(array $data) : User
    {
        return new User();
    }
}
