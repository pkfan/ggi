<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimStatus extends Model
{
    use HasFactory;
    protected $fillable = ['claim_id','status','update_by'];
    protected $table='claim_status';
        public function claim()
    
    {
        return $this->belongsTo(Claim::class);
    }
}
