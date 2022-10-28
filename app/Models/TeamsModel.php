<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamsModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'team_name',
        'is_team_full'
    ];
}
