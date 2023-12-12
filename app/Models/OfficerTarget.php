<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficerTarget extends Model
{
    use HasFactory;

    protected $table = 'officer_targets';

    protected $guarded = ['id'];

    public function officer(){
        return $this->belongsTo(User::class);
    }
}
