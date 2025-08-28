<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapsPrePlan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'papspre_plan';

    protected $fillable = [
        'papsyearid',
        'papsyearname',
        'papsuserid',
        'papsusercampus',
        'papsuserfundsource',
    ];

    public function items()
    {
        return $this->hasMany(PapsPrePlanItem::class, 'papspreplan_id');
    }
}
