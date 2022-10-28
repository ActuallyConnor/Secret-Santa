<?php

declare(strict_types=1);

namespace App\Domain\TeamMembers;

use LogicException;
use Ramsey\Uuid\UuidInterface;

final class TeamMember
{
    private ?int $id;
    private UuidInterface $uuid;
    private UuidInterface $user;
    private UuidInterface $team;
    private bool $isTeamCaptain;

    /**
     * @param  int|null  $id
     * @param  UuidInterface  $uuid
     * @param  UuidInterface  $user
     * @param  UuidInterface  $team
     * @param  bool  $isTeamCaptain
     */
    public function __construct(
        ?int $id,
        UuidInterface $uuid,
        UuidInterface $user,
        UuidInterface $team,
        bool $isTeamCaptain
    ) {
        $this->id            = $id;
        $this->uuid          = $uuid;
        $this->user          = $user;
        $this->team          = $team;
        $this->isTeamCaptain = $isTeamCaptain;
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
     * @return TeamMember
     */
    public function withId(int $id) : TeamMember
    {
        $new     = clone $this;
        $new->id = $id;

        return $new;
    }

    /**
     * @return TeamMember
     */
    public function withoutId() : TeamMember
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
     * @return TeamMember
     */
    public function withUuid(UuidInterface $uuid) : TeamMember
    {
        $new       = clone $this;
        $new->uuid = $uuid;

        return $new;
    }

    /**
     * @return UuidInterface
     */
    public function getUser() : UuidInterface
    {
        return $this->user;
    }

    /**
     * @param  UuidInterface  $user
     *
     * @return TeamMember
     */
    public function withUser(UuidInterface $user) : TeamMember
    {
        $new       = clone $this;
        $new->user = $user;

        return $new;
    }

    /**
     * @return UuidInterface
     */
    public function getTeam() : UuidInterface
    {
        return $this->team;
    }

    /**
     * @param  UuidInterface  $team
     *
     * @return TeamMember
     */
    public function withTeam(UuidInterface $team) : TeamMember
    {
        $new       = clone $this;
        $new->team = $team;

        return $new;
    }

    /**
     * @return bool
     */
    public function isTeamCaptain() : bool
    {
        return $this->isTeamCaptain;
    }

    /**
     * @param  bool  $isTeamCaptain
     *
     * @return TeamMember
     */
    public function withIsTeamCaptain(bool $isTeamCaptain) : TeamMember
    {
        $new                = clone $this;
        $new->isTeamCaptain = $isTeamCaptain;

        return $new;
    }
}
