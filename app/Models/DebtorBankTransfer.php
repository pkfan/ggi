<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DebtorBankTransfer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function verifier(){
        return $this->belongsTo(User::class, 'verified_by', 'id');
    }
}
