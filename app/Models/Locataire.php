<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_locataire';

    protected $fillable = [
        'Nom',
        'Prenom',
        'Adresse',
        'Telephone',
        'Email',
        'bancaire',
        'ID_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_user', 'ID_user');
    }
    public function boxs()
    {
        return $this->hasMany(Box::class, 'ID_locataire', 'ID_locataire');
    }
    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'ID_locataire', 'ID_locataire');
    }
    public function factures()
    {
        return $this->hasMany(Facture::class, 'ID_locataire', 'ID_locataire');
    }
    public function payements()
    {
        return $this->hasMany(Payement::class, 'ID_locataire', 'ID_locataire');
    }
}
