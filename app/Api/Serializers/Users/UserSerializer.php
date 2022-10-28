<?php

declare(strict_types=1);

namespace App\Api\Serializers\Users;

use App\Domain\Users\User;
use Ramsey\Uuid\Uuid;

final class UserSerializer
{
    /**
     * @param  User  $user
     *
     * @return array
     */
    public function serialize(User $user) : array
    {
        $serialized = [];

        if ($user->hasId()) {
            $serialized['id'] = $user->getId();
        }

        $serialized['uuid']  = $user->getUuid()->toString();
        $serialized['name']  = $user->getName();
        $serialized['email'] = $user->getEmail();

        return $serialized;
    }

    /**
     * @param  array  $data
     *
     * @return User
     */
    public function deserialize(array $data) : User
    {
        return new User(
            $data['id'] ?? null,
            Uuid::fromString($data['uuid']),
            $data['name'],
            $data['email']
        );
    }
}
