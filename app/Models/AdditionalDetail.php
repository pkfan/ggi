<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalDetail extends Model
{
    use HasFactory;
    protected $table = 'additional_detail';
    protected $fillable = ['claim_id', 'reference_no','date_time', 'remarks'];
}
