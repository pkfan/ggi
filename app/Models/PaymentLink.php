<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLink extends Model
{
    use HasFactory;
    protected $table='payment_links';
    
    public function paymnetLink()
    {
        return $this->belongsTo(Claim::class);
    }
}