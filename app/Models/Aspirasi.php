<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasi';
    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'isi',
        'status',
    ];

    // Relasi ke User (siswa pengirim)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi ke Feedback
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    // Relasi ke Progress
    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}