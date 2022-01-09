<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    use HasFactory;
    protected $table = 'thuong_hieu';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'ten', 'gioithieu', 'namthanhlap', 'anh'
    ];
}