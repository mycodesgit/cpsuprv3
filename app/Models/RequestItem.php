<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'item_request';

    protected $fillable = [
        'transaction_no',
        'purpose_id',
        'category_id',
        'unit_id',
        'item_id',
        'item_cost',
        'qty',
        'total_cost',
        'user_id',
        'off_id',
        'campid',
        'status',
        'date_approve_pending',
        'remember_token',
    ];
}
