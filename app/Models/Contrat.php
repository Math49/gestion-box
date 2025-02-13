<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_contrat';

    protected $fillable = [
        'Date_debut',
        'Date_fin',
        'ID_locataire',
        'ID_box',
        'ID_user',
        'Status',
        'Lien'
    ];

    public function locataire()
    {
        return $this->belongsTo(Locataire::class, 'ID_locataire', 'ID_locataire');
    }
    public function boxs()
    {
        return $this->belongsTo(Box::class, 'ID_box', 'ID_box');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_user', 'ID_user');
    }
}
