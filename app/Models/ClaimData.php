<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimData extends Model
{
    use HasFactory;
    protected $table="claim_data";

    protected $guarded = ['id'];

    public function claim()
    {
        return $this->belongsTo(ClaimData::class);
    }



}
