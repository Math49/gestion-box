<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_box';
    protected $table = 'boxes';

    protected $fillable = [
        'name',
        'address',
        'description',
        'price',
        'id_owner',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_owner');
    }
    
}
