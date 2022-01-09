<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'san_pham';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id', 'id_danh_muc', 'ten', 'mota', 'gia', 'soluongban', 'ngaydang', 'anh'
    ];

    public function danhmuc()
    {
        return $this->belongsTo(DanhMuc::class, 'id_danh_muc');
    }
}