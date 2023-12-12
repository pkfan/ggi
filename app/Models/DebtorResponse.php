<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtorResponse extends Model
{
    use HasFactory;
    protected $table='debtorresponses';
    
    public function claimRes()
    
    {
        return $this->belongsTo(Claim::class);
    }
}
