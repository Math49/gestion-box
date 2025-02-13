<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_contrat';
    protected $fillable = ['Date_debut', 'Date_fin', 'ID_locataire', 'ID_box', 'ID_user'];

    public function locataire()
    {
        return $this->belongsTo(Locataire::class, 'ID_locataire', 'ID_locataire');
    }

    public function box()
    {
        return $this->belongsTo(Box::class, 'ID_box', 'ID_box');
    }
}