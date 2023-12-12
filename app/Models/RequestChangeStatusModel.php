<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestChangeStatusModel extends Model
{
    use HasFactory;
    protected $table = 'request_change_status';
    protected $fillable = ['claim_id','current_status','new_status','reason'];
}
