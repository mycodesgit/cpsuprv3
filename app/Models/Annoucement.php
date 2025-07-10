<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annoucement extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'annouce';

    protected $fillable = [
        'announcement',
        'datestart',
        'dateend',
        'status',
    ];
}
