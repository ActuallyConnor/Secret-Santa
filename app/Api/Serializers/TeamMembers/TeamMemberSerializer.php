<?php

declare(strict_types=1);

namespace App\Api\Serializers\TeamMembers;

use App\Domain\TeamMembers\TeamMember;
use Ramsey\Uuid\Uuid;

final class TeamMemberSerializer
{
    /**
     * @param  TeamMember  $teamMember
     *
     * @return array
     */
    public function serialize(TeamMember $teamMember) : array
    {
        $serialized = [];

        if ($teamMember->hasId()) {
            $serialized['id'] = $teamMember->getId();
        }

        $serialized['uuid']          = $teamMember->getUuid()->toString();
        $serialized['user']          = $teamMember->getUser()->toString();
        $serialized['team']          = $teamMember->getTeam()->toString();
        $serialized['isTeamCaptain'] = $teamMember->isTeamCaptain();

        return $serialized;
    }

    /**
     * @param  array  $data
     *
     * @return TeamMember
     */
    public function deserialize(array $data) : TeamMember
    {
        return new TeamMember(
            $data['id'] ?? null,
            Uuid::fromString($data['uuid']),
            Uuid::fromString($data['user']),
            Uuid::fromString($data['team']),
            $data['isTeamCaptain']
        );
    }
}
