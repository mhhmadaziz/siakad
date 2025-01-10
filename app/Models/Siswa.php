<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nisn',
        'nipd',
        'tempat_lahir',
        'tanggal_lahir',
        'agama_id',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'kelurahan',
        'kecamatan',
        'nama_ayah',
        'nama_ibu'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agama()
    {
        return $this->belongsTo(Option::class, 'agama_id');
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
