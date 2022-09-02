<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $table = 'mejas';
    protected $fillable = ['no_meja', 'nama_meja', 'status_meja', 'qrcode', 'link'];
}
