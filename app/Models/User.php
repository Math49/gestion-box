<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'structure',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function boxes()
    {
        return $this->hasMany(Box::class, 'id_owner', 'id_user');
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'data_owner_id', 'id_user');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'id_user', 'id_user');
    }

    public function contractsModels()
    {
        return $this->hasMany(ContractModel::class, 'id_owner', 'id_user');
    }

}
