<?php

namespace App\Models;

use App\Services\OptionService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class KehadiranSiswa extends Model
{
    protected $table = 'kehadiran_siswa';

    protected $fillable = [
        'tanggal',
        'jadwal_mata_pelajaran_id',
    ];

    public function jadwalMataPelajaran()
    {
        return $this->belongsTo(JadwalMataPelajaran::class);
    }

    public function kehadiranSiswaChildren()
    {
        return $this->hasMany(KehadiranSiswaChild::class, 'kehadiran_siswa_id');
    }

    public function getFullTimeAttribute()
    {
        // format menjadi hari, tanggal bulan tahun jam:menit
        return Carbon::parse($this->tanggal)->translatedFormat('l, h F Y') . ' ' . $this->jadwalMataPelajaran->jam;
    }

    public function getStatistikAttribute()
    {
        $statusKehadiran = app(OptionService::class)->getSelectOptionsByCategoryKey('status_kehadiran');
        $statistik = $this->kehadiranSiswaChildren->groupBy('status_kehadiran_id')->map(function ($item, $key) {
            return $item->count();
        });

        return $statusKehadiran->map(function ($item) use ($statistik) {

            // jika label adalah Tidak Hadir maka totalnya adalah jumlah siswa dikurangi jumlah yang hadir
            if ($item->label === 'Tidak Hadir') {
                $jumlahSiswa = $this->jadwalMataPelajaran->mataPelajaran->kelas->siswas->count();
                $total = $jumlahSiswa - (
                    $statistik->get(app(OptionService::class)->getOptionValueByName('Hadir')->id) ?? 0 +
                    $statistik->get(app(OptionService::class)->getOptionValueByName('Izin')->id) ?? 0 +
                    $statistik->get(app(OptionService::class)->getOptionValueByName('Terlambat')->id) ?? 0

                );
            } else {
                $total = $statistik->get($item->value) ?? 0;
            }


            return (object) [
                'value' => $item->value,
                'label' => $item->label,
                'total' => $total,
            ];
        });
    }
}
