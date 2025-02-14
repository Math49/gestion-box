<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractModel extends Model
{
    use HasFactory;

    protected $table = 'contract_models';
    protected $primaryKey = 'id_contractModels';
    protected $fillable = [
        'name',
        'content',
        'id_owner'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_owner');
    }
}
