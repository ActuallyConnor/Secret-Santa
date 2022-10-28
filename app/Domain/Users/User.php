<?php

declare(strict_types=1);

namespace App\Domain\Users;

use LogicException;
use Ramsey\Uuid\UuidInterface;

final class User
{
    private ?int $id;
    private UuidInterface $uuid;
    private string $name;
    private string $email;

    /**
     * @param  int|null  $id
     * @param  UuidInterface  $uuid
     * @param  string  $name
     * @param  string  $email
     */
    public function __construct(?int $id, UuidInterface $uuid, string $name, string $email)
    {
        $this->id    = $id;
        $this->uuid  = $uuid;
        $this->name  = $name;
        $this->email = $email;
    }

    public function hasId() : bool
    {
        return !is_null($this->id);
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        if (is_null($this->id)) {
            throw new LogicException('There is no ID');
        }

        return $this->id;
    }

    /**
     * @param  int  $id
     *
     * @return User
     */
    public function withId(int $id) : User
    {
        $new     = clone $this;
        $new->id = $id;

        return $new;
    }

    /**
     * @return User
     */
    public function withoutId() : User
    {
        $new     = clone $this;
        $new->id = null;

        return $new;
    }

    /**
     * @return UuidInterface
     */
    public function getUuid() : UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @param  UuidInterface  $uuid
     *
     * @return User
     */
    public function withUuid(UuidInterface $uuid) : User
    {
        $new       = clone $this;
        $new->uuid = $uuid;

        return $new;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     *
     * @return User
     */
    public function withName(string $name) : User
    {
        $new       = clone $this;
        $new->name = $name;

        return $new;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param  string  $email
     *
     * @return User
     */
    public function withEmail(string $email) : User
    {
        $new        = clone $this;
        $new->email = $email;

        return $new;
    }
}
