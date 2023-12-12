<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalDepartmentModel extends Model
{
    use HasFactory;

    protected $table = 'legal_department_model';
    protected $fillable = ['claim_id','status', 'court', 'remarks'];

}
