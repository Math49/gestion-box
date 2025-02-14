<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_bill';

    protected $fillable = [
        'payement_price',
        'payement_date',
        'period_number',
        'id_contract',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'id_contract');
    }
}
