<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficerDiscountRate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function officer(){
        return $this->belongsTo(User::class, 'officer_id','id');
    }

    public function setter(){
        return $this->belongsTo(User::class, 'set_by','id');
    }


}
