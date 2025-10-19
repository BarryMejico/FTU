<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class module extends Model
{
    use HasFactory;
    protected $table = 'modules';
    protected $primaryKey = 'Module_ID';
    protected $fillable=[
        'Module_Name',
        'Module_Description',
        'Module_percentage',
        'Module_nr_hrs',
    ];

}
