<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'campuses';

    protected $fillable = [
        'campus_name',
        'campus_abbr',
    ];
}
