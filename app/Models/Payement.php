<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_payement';

    protected $fillable = [
        'Date_payement',
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
