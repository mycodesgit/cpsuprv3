<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpmpVerify extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'ppmpverify';

    protected $fillable = [
        'user_id',
        'camp_id',
        'office_id',
        'purpose_id',
        'ppmp_remarks',
        'prstatus',
        'remember_token',
    ];
}
