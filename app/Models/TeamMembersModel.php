<?php

namespace App\Models;

use App\Domain\TeamMembers\TeamMember;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TeamMembersModel extends Model
{
    use HasFactory;

    protected $table = 'team_members';

    protected $fillable = [
        'uuid',
        'user',
        'team',
        'is_team_captain'
    ];

    /**
     * @param  UuidInterface  $uuid
     *
     * @return TeamMember
     */
    public function findByUuid(UuidInterface $uuid) : TeamMember
    {
        return $this->parse(TeamMembersModel::where('uuid', $uuid->toString())->first());
    }

    /**
     * @param  TeamMember  $teamMember
     */
    public function createTeamMember(TeamMember $teamMember) : void
    {
        TeamMembersModel::create([
            'uuid'            => $teamMember->getUuid()->toString(),
            'user'            => $teamMember->getUser()->toString(),
            'team'            => $teamMember->getTeam()->toString(),
            'is_team_captain' => $teamMember->isTeamCaptain()
        ]);
    }

    /**
     * @param  TeamMembersModel  $teamMembersModel
     *
     * @return TeamMember
     */
    private function parse(TeamMembersModel $teamMembersModel) : TeamMember
    {
        return new TeamMember(
            $teamMembersModel->id,
            Uuid::fromString($teamMembersModel->uuid),
            Uuid::fromString($teamMembersModel->user),
            Uuid::fromString($teamMembersModel->team),
            $teamMembersModel->is_team_captain
        );
    }
}
