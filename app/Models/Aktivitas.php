<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;
    protected $fillable = ['nama_aktivitas', 'durasi', 'kalori_terbakar', 'waktu_aktivitas',  'user_id'];
}
