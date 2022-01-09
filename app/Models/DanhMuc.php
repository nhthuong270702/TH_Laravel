<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table = 'danh_muc';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id', 'ten', 'anh'
    ];

    public function sanphams()
    {
        return $this->hasMany(SanPham::class);
    }
}