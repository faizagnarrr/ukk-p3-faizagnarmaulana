<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    
    protected $fillable = ['aspirasi_id','keterangan'];
    
    public function aspirasi() {
    return $this->belongsTo(Aspirasi::class);
    }
}