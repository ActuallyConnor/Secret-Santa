<?php

declare(strict_types=1);

namespace App\Domain\Teams;

use LogicException;
use Ramsey\Uuid\UuidInterface;

final class Team
{
    private ?int $id;
    private UuidInterface $uuid;
    private string $name;
    private bool $isTeamFull;
    /** @var array<UuidInterface> */
    private array $teamMembers;
    /** @var array<string, string> */
    private array $matches;

    /**
     * @param  int|null  $id
     * @param  UuidInterface  $uuid
     * @param  string  $name
     * @param  bool  $isTeamFull
     * @param  UuidInterface[]  $teamMembers
     * @param  string[]  $matches
     */
    public function __construct(
        ?int $id,
        UuidInterface $uuid,
        string $name,
        bool $isTeamFull,
        array $teamMembers,
        array $matches
    ) {
        $this->id          = $id;
        $this->uuid        = $uuid;
        $this->name        = $name;
        $this->isTeamFull  = $isTeamFull;
        $this->teamMembers = $teamMembers;
        $this->matches     = $matches;
    }

    /**
     * @return bool
     */
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
     * @return Team
     */
    public function withId(int $id) : Team
    {
        $new     = clone $this;
        $new->id = $id;

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
     * @return Team
     */
    public function withUuid(UuidInterface $uuid) : Team
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
     * @return Team
     */
    public function withName(string $name) : Team
    {
        $new       = clone $this;
        $new->name = $name;

        return $new;
    }

    /**
     * @return bool
     */
    public function isTeamFull() : bool
    {
        return $this->isTeamFull;
    }

    /**
     * @param  bool  $isTeamFull
     *
     * @return Team
     */
    public function withIsTeamFull(bool $isTeamFull) : Team
    {
        $new             = clone $this;
        $new->isTeamFull = $isTeamFull;

        return $new;
    }

    /**
     * @return UuidInterface[]
     */
    public function getTeamMembers() : array
    {
        return $this->teamMembers;
    }

    /**
     * @param  UuidInterface[]  $teamMembers
     */
    public function withTeamMembers(array $teamMembers) : Team
    {
        $new              = clone $this;
        $new->teamMembers = $teamMembers;

        return $new;
    }

    /**
     * @return bool
     */
    public function hasMatches() : bool
    {
        return !empty($this->matches);
    }

    /**
     * @return string[]
     */
    public function getMatches() : array
    {
        return $this->matches;
    }

    /**
     * @param  string[]  $matches
     */
    public function withMatches(array $matches) : Team
    {
        $new          = clone $this;
        $new->matches = $matches;

        return $new;
    }
}
