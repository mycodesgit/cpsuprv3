<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uacs extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'uacs';

    protected $fillable = [
        'uacs_code',
        'uacs_title',
        'uacs_category',
    ];
}
