<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocFile extends Model
{
    use HasFactory;
     protected $primaryKey = 'id';
    protected $table = 'docfile';

    protected $fillable = [
        'purpose_id',
        'user_id',
        'doc_file',
        'ppmp_file',
        'remember_token',
    ];
}
