<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    use HasFactory;
        protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'rank',
        'birthday',
        'age',
        'contact_number',
        'address',
        'gender',
    ];
}
