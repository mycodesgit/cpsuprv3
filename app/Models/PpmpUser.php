<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpmpUser extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'ppmpuser';

    protected $fillable = [
        'user_id',
        'ppmp_categories',
    ];
}
