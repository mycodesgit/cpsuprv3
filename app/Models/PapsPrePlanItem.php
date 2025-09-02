<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapsPrePlanItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'paspre_plan_items';

    protected $fillable = [
        'papspreplan_id',
        'papspreplanyearname',
        'ppa_cat',
        'ppa_catsub',
        'ppa',
        'papsprecode',
        'papstitle',
        'papsamount',
        'papsprocyn',
        'papsresperson',
        'papsevidences',
        'jan', 'feb', 'mar', 'apr', 'may', 'jun',
        'jul', 'aug', 'sep', 'oct', 'nov', 'dec',
    ];

    public function plan()
    {
        return $this->hasMany(PapsPrePlan::class, 'papspreplan_id');
    }
}
