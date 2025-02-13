<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContrat extends Model
{
    use HasFactory;

    protected $table = 'type_contrat';
    protected $fillable = ['nom', 'contenu'];

    public function boxs()
    {
        return $this->hasMany(Box::class, 'ID_typeContrat', 'ID_typeContrat');
    }
}
