<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perusahaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_perusahaan', 'bidang_usaha', 'alamat',
        'nama_pembimbing_industri', 'telepon',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
