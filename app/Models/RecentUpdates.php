<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentUpdates extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'recentupdates';

    protected $fillable = [
        'otherannouncement',
        'postedby',
        'status'
    ];
}
