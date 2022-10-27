<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMembers extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_uuid',
        'team_uuid',
        'is_team_captain'
    ];
}
