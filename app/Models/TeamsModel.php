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
            'uuid'         => $team->getUuid()->toString(),
            'name'         => $team->getName(),
            'is_team_full' => $team->isTeamFull(),
            'team_members' => json_encode(array_map(
                fn($teamMember) => $teamMember->toString(),
                $team->getTeamMembers()
            )),
            'matches'      => json_encode($team->getMatches())
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
            $teamsModel->is_team_full,
            array_map(
                fn($teamMemberUuid) => Uuid::fromString($teamMemberUuid),
                json_decode($teamsModel->team_members, true)
            ),
            isset($teamsModel->matches) ? json_decode($teamsModel->matches, true) : []
        );
    }
}
