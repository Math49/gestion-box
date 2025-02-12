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

    /**
     * Get the boxes for the user.
     */
    public function boxes()
    {
        return $this->hasMany(Box::class, 'ID_user', 'ID_user');
    }
    public function locataires()
    {
        return $this->hasMany(Locataire::class, 'ID_user', 'ID_user');
    }
    public function payements()
    {
        return $this->hasMany(Payement::class, 'ID_user', 'ID_user');
    }
    public function factures()
    {
        return $this->hasMany(Facture::class, 'ID_user', 'ID_user');
    }
    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'ID_user', 'ID_user');
    }

}
