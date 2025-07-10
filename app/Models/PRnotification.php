<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRnotification extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'prnotification';

    protected $fillable = [
        'purp_id',
        'user_id',
        'message',
        'notifstatus',
        'is_read',
    ];
}
