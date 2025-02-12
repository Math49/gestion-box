<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'Date_facture',
        'Montant',
        'ID_locataire',
        'ID_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_user', 'ID_user');
    }
    public function locataire()
    {
        return $this->belongsTo(Locataire::class, 'ID_locataire', 'ID_locataire');
    }
}
