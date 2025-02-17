<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_contract';
    protected $fillable = [
        'date_end',
        'date_start',
        'monthly_price',
        'content',
        'id_box',
        'id_tenant',
        'id_user',
    ];

    public function box()
    {
        return $this->belongsTo(Box::class, 'id_box');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'id_tenant');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class, 'id_contract');
    }
}