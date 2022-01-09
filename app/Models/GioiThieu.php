<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioiThieu extends Model
{
    use HasFactory;
    protected $table = 'gioi_thieu';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'tieude', 'noidung', 'tieuchi1', 'tieuchi2', 'tieuchi3', 'anh'
    ];
}