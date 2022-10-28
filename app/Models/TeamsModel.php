<?php

namespace App\Models;

use App\Domain\Teams\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TeamsModel extends Model
{
    use HasFactory;

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
     */
    public function findByUuid(UuidInterface $uuid) : Team
    {
        return $this->parse(TeamsModel::where('uuid', $uuid->toString())->first());
    }

    /**
     * @param  Team  $team
     */
    public function createTeam(Team $team) : void
    {
        TeamsModel::create([
            'uuid'        => $team->getUuid()->toString(),
            'name'        => $team->getName(),
            'isTeamFull'  => $team->isTeamFull(),
            'teamMembers' => array_map(
                fn($teamMember) => $teamMember->toString(),
                $team->getTeamMembers()
            ),
            'matches'     => $team->getMatches()
        ]);
    }

    /**
     * @param  TeamsModel  $teamsModel
     *
     * @return Team
     */
    private function parse(TeamsModel $teamsModel) : Team
    {
        return new Team(
            $teamsModel->id,
            Uuid::fromString($teamsModel->uuid),
            $teamsModel->name,
            $teamsModel->isTeamFull,
            array_map(
                fn($teamMemberUuid) => Uuid::fromString($teamMemberUuid),
                $teamsModel->teamMembers
            ),
            $teamsModel->matches ?? []
        );
    }
}
