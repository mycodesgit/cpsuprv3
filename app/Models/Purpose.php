<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'purpose';

    protected $fillable = [
        'user_id',
        'camp_id',
        'office_id',
        'transaction_no',
        'pr_no',
        'type_request',
        'cat_id',
        'purpose_name',
        'pstatus',
        'datetech',
        'dateproc',
        'datebud',
        'datereceived',
        'datecanvassing',
        'datecanvassed',
        'datephilgeps',
        'dateposted',
        'datebidding',
        'dateconsolidate',
        'dateawarded',
        'datepurchase',
        'datereturned',
        'dateforwarded',
        'officeidreturn',
        'remember_token',
    ];

    // public function items()
    // {
    //     return $this->hasMany(RequestItem::class, 'purpose_id', 'id')
    //     ->where('status', 1);
    // }

}
