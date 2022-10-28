<?php

declare(strict_types=1);

namespace App\Domain\Users;

use Ramsey\Uuid\UuidInterface;

final class User
{
    private ?int $id;
    private UuidInterface $uuid;
}
