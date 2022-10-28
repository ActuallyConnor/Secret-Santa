<?php

declare(strict_types=1);

namespace App\Api\Serializers\Teams;

use App\Domain\Teams\Team;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class TeamSerializer
{
    /**
     * @param  Team  $team
     *
     * @return array
     */
    public function serialize(Team $team) : array
    {
        $serialized = [];

        if ($team->hasId()) {
            $serialized['id'] = $team->getId();
        }

        $serialized['uuid']       = $team->getUuid()->toString();
        $serialized['name']       = $team->getName();
        $serialized['isTeamFull'] = $team->isTeamFull();

        $serialized['teamMembers'] = array_map(
            fn(UuidInterface $uuid) => $uuid->toString(),
            $team->getTeamMembers()
        );

        if ($team->hasMatches()) {
            $serialized['matches'] = $team->getMatches();
        }

        return $serialized;
    }

    /**
     * @param  array  $data
     *
     * @return Team
     */
    public function deserialize(array $data) : Team
    {
        return new Team(
            $data['id'] ?? null,
            Uuid::fromString($data['uuid']),
            $data['name'],
            $data['isTeamFull'],
            array_map(
                fn($teamMemberUuid) => Uuid::fromString($teamMemberUuid),
                $data['teamMembers']
            ),
            $data['matches'] ?? []
        );
    }
}
