<?php

namespace App\Models;

use App\Domain\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;
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
        return $this->parse(UserModel::where('uuid', $uuid->toString())->first());
    }

    /**
     * @param  User  $user
     */
    public function createUser(User $user) : void
    {
        UserModel::create([
            'uuid'  => $user->getUuid()->toString(),
            'name'  => $user->getName(),
            'email' => $user->getEmail()
        ]);
    }

    /**
     * @param  UserModel  $userModel
     *
     * @return User
     */
    private function parse(UserModel $userModel) : User
    {
        return new User(
            $userModel->id,
            Uuid::fromString($userModel->uuid),
            $userModel->name,
            $userModel->email
        );
    }
}
