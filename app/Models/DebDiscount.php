<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebDiscount extends Model
{
    use HasFactory;

    public $table = "deb_discounts";

    protected $guarded = ['id'];

    public function processor(){
        return $this->belongsTo(User::class, 'process_by', 'id');
    }
    public function officer(){
        return $this->belongsTo(User::class, 'requested_by', 'id');
    }

}
