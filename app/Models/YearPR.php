<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearPR extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'yearpr';

    protected $fillable = [
        'pryear',
        'status',
    ];
}
