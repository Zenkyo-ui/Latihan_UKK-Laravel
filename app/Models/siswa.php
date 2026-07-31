<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $fillable = [
 'nis', 'nama', 'kelas', 'tanggal_mulai_pkl',
 'tanggal_selesai_pkl', 'perusahaan_id', 'tanggal_mulai_pkl', 'tanggal_selesai_pkl',
 ];
 
 public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function kompetensi() 
{
    return $this->belongsToMany(
        Kompetensi::class,
        'siswa_kompetensi'
    )->withPivot('nilai');
}
}
