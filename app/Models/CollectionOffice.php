<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionOffice extends Model
{
    use HasFactory;
    protected $table = 'collection_office';
    protected $fillable = ['claim_id','collector_id','remarks'];
}
