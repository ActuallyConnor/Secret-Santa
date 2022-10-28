<?php

namespace App\Models;

use App\Domain\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\UuidInterface;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * @param  UuidInterface  $uuid
     *
     * @return User
     */
    public function findUserByUuid(UuidInterface $uuid) : User
    {
        return UserModel::where('uuid', $uuid->getBytes())->first();
    }

    /**
     * @param  User  $user
     */
    public function createUser(User $user) : void
    {
        UserModel::create([
            'uuid'  => $user->getUuid()->getBytes(),
            'name'  => $user->getName(),
            'email' => $user->getEmail()
        ]);
    }
}
