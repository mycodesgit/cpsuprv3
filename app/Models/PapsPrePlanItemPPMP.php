<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapsPrePlanItemPPMP extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'papspre_plan_items_ppmp';

    protected $fillable = [
        'papspreplanid',
        'papspreplanitemsid',
        'quantity_size',
        'mode_of_procurement'
    ];
}
