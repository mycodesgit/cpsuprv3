<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'unit';

    protected $fillable = [
        'unit_name',
        'remember_token',
    ];
}
