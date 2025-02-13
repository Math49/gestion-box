<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_box';
    protected $table = 'boxs';

    protected $fillable = [
        'Nom',
        'Adresse',
        'Description',
        'ID_typeContrat',
        'Prix',
        'ID_locataire',
        'ID_user',
    ];

    public function locataire()
    {
        return $this->belongsTo(Locataire::class, 'ID_locataire', 'ID_locataire');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_user', 'ID_user');
    }

    public function typeContrat()
    {
        return $this->belongsTo(TypeContrat::class, 'ID_typeContrat', 'ID_typeContrat');
    }
}
