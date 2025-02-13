<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tenant';

    protected $fillable = [
        'name',
        'firstname',
        'email',
        'phone',
        'address',
        'data_owner_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'data_owner_id', 'id_user');
    }
}
