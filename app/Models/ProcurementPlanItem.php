<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementPlanItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'procurement_plan_items';

    protected $fillable = [
        'plan_id',
        'planyearname',
        'code',
        'pap',
        'general_description',
        'quantity_size',
        'estimated_budget',
        'mode_of_procurement',
        'jan', 'feb', 'mar', 'apr', 'may', 'jun',
        'jul', 'aug', 'sep', 'oct', 'nov', 'dec',
    ];

    public function plan()
    {
        return $this->hasMany(ProcurementPlan::class, 'plan_id');
    }
}
