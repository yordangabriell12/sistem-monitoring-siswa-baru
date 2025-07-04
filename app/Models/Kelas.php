<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'pengajar_id',
        'jadwal',
    ];

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class, 'pengajar_id');
    }
}
