<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMuc extends Model
{
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $table = 'danh_muc';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id', 'ten', 'anh'
    ];

    public function sanphams()
    {
        return $this->hasMany(SanPham::class, 'id_danh_muc');
    }
}