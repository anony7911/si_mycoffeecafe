<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $fillable = ['pelanggan_id', 'meja_id', 'menu_id', 'jumlah', 'total', 'status_pesanan'];
    protected $table = 'pesanans';
}
