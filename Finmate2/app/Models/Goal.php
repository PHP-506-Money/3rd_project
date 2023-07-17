<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model
{
    use HasFactory;

    // protected $table = 'goals';
    use SoftDeletes;

    protected $primaryKey = 'goalno';

    protected $fillable = ['deleted_at'];
}
