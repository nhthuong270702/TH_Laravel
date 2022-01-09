<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'blogs';
    protected $fillable = [
        'id', 'user_id', 'tieude', 'noidung', 'anh',  'ngaydang', 'sobinhluan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}