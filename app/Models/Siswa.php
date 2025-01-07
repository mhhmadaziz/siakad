<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nisn',
        'status_keluarga_id',
        'ttl',
        'anak_ke',
        'agama_id',
        'alamat',
        'asal_sekolah',
        'tgl_masuk',
        'diterima_kelas',
        'status',
        'nama_ayah',
        'nama_ibu',
        'alamat_orang_tua',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'nomor_telepon_ayah',
        'nomor_telepon_ibu',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agama()
    {
        return $this->belongsTo(Option::class, 'agama_id');
    }

    public function statusKeluarga()
    {
        return $this->belongsTo(Option::class, 'status_keluarga_id');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_siswa', 'siswa_id', 'kelas_id');
    }

    public function kelasSiswa()
    {
        return $this->hasMany(KelasSiswa::class);
    }
}
