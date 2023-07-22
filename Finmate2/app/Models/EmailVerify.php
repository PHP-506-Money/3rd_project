<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerify extends Model
{
    use HasFactory;

    protected $table = 'emailverifies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'userid',
        'useremail',
        'token',
        'expire_at',
    ];
}
