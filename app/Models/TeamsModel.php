<?php

namespace App\Models;

use App\Api\JSON;
use App\Domain\Teams\Team;
use App\Exceptions\TeamNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JsonException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TeamsModel extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'uuid',
        'name',
        'is_team_full',
        'team_members',
        'matches'
    ];

    /**
     * @param  UuidInterface  $uuid
     *
     * @return Team
     * @throws JsonException
     * @throws TeamNotFoundException
     */
    public function findByUuid(UuidInterface $uuid) : Team
    {
        $team = TeamsModel::where('uuid', $uuid->toString())->first();

        if (is_null($team)) {
            throw new TeamNotFoundException(sprintf('Team not found "%s"', $uuid->toString()));
        }

        return $this->parse($team);
    }

    /**
     * @param  Team  $team
     *
     * @throws JsonException
     */
    public function createTeam(Team $team) : void
    {
        TeamsModel::create([
            'uuid'         => $team->getUuid()->toString(),
            'name'         => $team->getName(),
            'is_team_full' => $team->isTeamFull(),
            'team_members' => JSON::encode(array_map(
                fn($teamMember) => $teamMember->toString(),
                $team->getTeamMembers()
            )),
            'matches'      => JSON::encode($team->getMatches())
        ]);
    }

    /**
     * @param  TeamsModel  $teamsModel
     *
     * @return Team
     * @throws JsonException
     */
    private function parse(TeamsModel $teamsModel) : Team
    {
        return new Team(
            $teamsModel->id,
            Uuid::fromString($teamsModel->uuid),
            $teamsModel->name,
            $teamsModel->is_team_full,
            array_map(
                fn($teamMemberUuid) => Uuid::fromString($teamMemberUuid),
                JSON::decode($teamsModel->team_members, true)
            ),
            isset($teamsModel->matches) ? json_decode($teamsModel->matches, true) : []
        );
    }
}
