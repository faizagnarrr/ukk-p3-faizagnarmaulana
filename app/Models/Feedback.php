<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['aspirasi_id','admin_id','isi_feedback'];

    public function aspirasi() {
    return $this->belongsTo(Aspirasi::class);
    }

    public function admin() {
    return $this->belongsTo(User::class, 'admin_id');
    }

    
}