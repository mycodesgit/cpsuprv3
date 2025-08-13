<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementPlan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'procurement_plan';

    protected $fillable = [
        'pryearid',
        'pryearname',
        'pruserid',
        'prusercampus',
    ];

    public function items()
    {
        return $this->hasMany(ProcurementPlanItem::class, 'plan_id');
    }
}
