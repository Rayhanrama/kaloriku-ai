<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_makanan', 'jumlah_kalori', 'waktu_konsumsi', 'user_id'];

    /**
     * Get the user that owns the food record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
