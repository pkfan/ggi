<?php

namespace App\Models;

use App\Models\Claim;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollectedClaim extends Model
{
    use HasFactory;
    protected $table="claim_collected";

    protected $guarded = ['id'];

    public function claim(){
        return $this->belongsTo(Claim::class, 'claim_id');
    }

}
