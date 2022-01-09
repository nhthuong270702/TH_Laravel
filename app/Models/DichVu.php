<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichVu extends Model
{
    use HasFactory;
    protected $table = 'dinh_vu';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'ten', 'noidung', 'anh'
    ];
}