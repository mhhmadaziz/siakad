<?php

use App\Models\MataPelajaran;
use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.tahun-akademik.index', function (BreadcrumbTrail $trail) {
    $trail->push('Tahun Ajaran', route('admin.tahun-akademik.index'));
});

Breadcrumbs::for('admin.tahun-akademik.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.tahun-akademik.index');
    $trail->push('Tambah Tahun Ajaran', route('admin.tahun-akademik.create'));
});

Breadcrumbs::for('admin.tahun-akademik.show', function (BreadcrumbTrail $trail, $tahunAkademik) {
    $trail->parent('admin.tahun-akademik.index');
    $trail->push($tahunAkademik->name, route('admin.tahun-akademik.show', $tahunAkademik));
});

Breadcrumbs::for('admin.tahun-akademik.edit', function (BreadcrumbTrail $trail, $tahunAkademik) {
    $trail->parent('admin.tahun-akademik.show', $tahunAkademik);
    $trail->push('Edit', route('admin.tahun-akademik.edit', $tahunAkademik));
});


Breadcrumbs::for('admin.tahun-akademik.kelas', function (BreadcrumbTrail $trail, $tahunAkademik) {
    $trail->parent('admin.tahun-akademik.show', $tahunAkademik);
    $trail->push('Kelas', route('admin.tahun-akademik.kelas', $tahunAkademik));
});

Breadcrumbs::for('admin.tahun-akademik.kelas.create', function (BreadcrumbTrail $trail, $tahunAkademik) {
    $trail->parent('admin.tahun-akademik.kelas', $tahunAkademik);
    $trail->push('Tambah Kelas', route('admin.tahun-akademik.kelas.create', $tahunAkademik));
});

Breadcrumbs::for('admin.tahun-akademik.kelas.jadwal', function (BreadcrumbTrail $trail, $tahunAkademik, $kelas) {
    $trail->parent('admin.tahun-akademik.kelas', $tahunAkademik);
    $trail->push('Penjadwalan ' . $kelas->fullName, route('admin.tahun-akademik.kelas.jadwal', [$tahunAkademik, $kelas]));
});

Breadcrumbs::for('admin.tahun-akademik.ppdb', function (BreadcrumbTrail $trail, $tahunAkademik) {
    $trail->parent('admin.tahun-akademik.show', $tahunAkademik);
    $trail->push('PPDB', route('admin.tahun-akademik.ppdb', $tahunAkademik));
});

Breadcrumbs::for('admin.kelas.index', function (BreadcrumbTrail $trail) {
    $trail->push('Kelas', route('admin.kelas.index'));
});

Breadcrumbs::for('admin.kelas.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kelas.index');
    $trail->push('Tambah Kelas', route('admin.kelas.create'));
});

Breadcrumbs::for('admin.kelas.edit', function (BreadcrumbTrail $trail, $kelas) {
    $trail->parent('admin.kelas.show', $kelas);
    $trail->push('Edit', route('admin.kelas.edit', $kelas));
});

Breadcrumbs::for('admin.kelas.show', function (BreadcrumbTrail $trail, $kelas) {
    $trail->parent('admin.kelas.index');
    $trail->push($kelas->fullName, route('admin.kelas.show', $kelas));
});

Breadcrumbs::for('admin.kelas.mata-pelajaran.create', function (BreadcrumbTrail $trail, $kelas) {
    $trail->parent('admin.kelas.show', $kelas);
    $trail->push('Tambah Mata Pelajaran', route('admin.kelas.mata-pelajaran.create', $kelas));
});

Breadcrumbs::for('admin.guru.index', function (BreadcrumbTrail $trail) {
    $trail->push('Guru', route('admin.guru.index'));
});

Breadcrumbs::for('admin.guru.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.guru.index');
    $trail->push('Tambah Guru', route('admin.guru.create'));
});

Breadcrumbs::for('admin.guru.show', function (BreadcrumbTrail $trail, $guru) {
    $trail->parent('admin.guru.index');
    $trail->push($guru?->user?->name, route('admin.guru.show', $guru));
});

Breadcrumbs::for('admin.guru.edit', function (BreadcrumbTrail $trail, $guru) {
    $trail->parent('admin.guru.show', $guru);
    $trail->push('Edit', route('admin.guru.edit', $guru));
});

Breadcrumbs::for('admin.siswa.index', function (BreadcrumbTrail $trail) {
    $trail->push('Siswa', route('admin.siswa.index'));
});

Breadcrumbs::for('admin.siswa.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.siswa.index');
    $trail->push('Tambah Siswa', route('admin.siswa.create'));
});

Breadcrumbs::for('admin.siswa.show', function (BreadcrumbTrail $trail, $siswa) {
    $trail->parent('admin.siswa.index');
    $trail->push($siswa?->user?->name, route('admin.siswa.show', $siswa));
});

Breadcrumbs::for('admin.siswa.edit', function (BreadcrumbTrail $trail, $siswa) {
    $trail->parent('admin.siswa.show', $siswa);
    $trail->push('Edit', route('admin.siswa.edit', $siswa));
});

Breadcrumbs::for('admin.mata-pelajaran.index', function (BreadcrumbTrail $trail) {
    $trail->push('Mata Pelajaran', route('admin.mata-pelajaran.index'));
});

Breadcrumbs::for('admin.mata-pelajaran.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.mata-pelajaran.index');
    $trail->push('Tambah Mata Pelajaran', route('admin.mata-pelajaran.create'));
});

Breadcrumbs::for('admin.mata-pelajaran.edit', function (BreadcrumbTrail $trail, $mataPelajaran) {
    $trail->parent('admin.mata-pelajaran.index');
    $trail->push('Edit ' . $mataPelajaran->name, route('admin.mata-pelajaran.edit', $mataPelajaran));
});


Breadcrumbs::for('admin.kehadiran-siswa.index', function (BreadcrumbTrail $trail) {
    $trail->push('Kehadiran Siswa', route('admin.kehadiran-siswa.index'));
});

Breadcrumbs::for('admin.kehadiran-siswa.show', function (BreadcrumbTrail $trail, $kelas) {
    $trail->parent('admin.kehadiran-siswa.index');
    $trail->push($kelas->fullName, route('admin.kehadiran-siswa.show', $kelas));
});

Breadcrumbs::for('admin.kehadiran-siswa.mata-pelajaran.show', function (BreadcrumbTrail $trail, $kelas, $mataPelajaran) {
    $trail->parent('admin.kehadiran-siswa.show', $kelas);
    $trail->push($mataPelajaran->name, route('admin.kehadiran-siswa.mata-pelajaran.show', [$kelas, $mataPelajaran]));
});

Breadcrumbs::for('admin.kehadiran-siswa.create', function (BreadcrumbTrail $trail, $kelas, $mataPelajaran) {
    $trail->parent('admin.kehadiran-siswa.mata-pelajaran.show', $kelas, $mataPelajaran);
    $trail->push('Tambah Pertemuan', route('admin.kehadiran-siswa.create', [$kelas, $mataPelajaran]));
});

Breadcrumbs::for('admin.modul-pembelajaran.index', function (BreadcrumbTrail $trail) {
    $trail->push('Modul Pembelajaran', route('admin.modul-pembelajaran.index'));
});

Breadcrumbs::for('admin.modul-pembelajaran.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.modul-pembelajaran.index');
    $trail->push('Tambah Modul Pembelajaran', route('admin.modul-pembelajaran.create'));
});

Breadcrumbs::for('admin.modul-pembelajaran.show', function (BreadcrumbTrail $trail, $modulPembelajaran) {
    $trail->parent('admin.modul-pembelajaran.index');
    $trail->push($modulPembelajaran->name, route('admin.modul-pembelajaran.show', $modulPembelajaran));
});

Breadcrumbs::for('admin.cms.index', function (BreadcrumbTrail $trail) {
    $trail->push('Galeri dan Konten', route('admin.cms.index'));
});

Breadcrumbs::for('admin.cms.home.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.cms.index');
    $trail->push('Beranda', route('admin.cms.home.index'));
});

Breadcrumbs::for('admin.cms.galeri.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.cms.index');
    $trail->push('Galeri', route('admin.cms.galeri.index'));
});

Breadcrumbs::for('admin.cms.galeri.foto-create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.cms.galeri.index');
    $trail->push('Tambah Foto', route('admin.cms.galeri.foto-create'));
});

Breadcrumbs::for('admin.cms.galeri.video-create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.cms.galeri.index');
    $trail->push('Tambah Video', route('admin.cms.galeri.video-create'));
});

Breadcrumbs::for('admin.cms.kalender.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.cms.index');
    $trail->push('Kalender', route('admin.cms.kalender.index'));
});

Breadcrumbs::for('admin.cms.ppdb.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.cms.index');
    $trail->push('PPDB', route('admin.cms.ppdb.index'));
});

Breadcrumbs::for('admin.cms.ppdb.show', function (BreadcrumbTrail $trail, $tahunAkademik) {
    $trail->parent('admin.cms.ppdb.index');
    $trail->push($tahunAkademik->name, route('admin.cms.ppdb.show', $tahunAkademik));
});

Breadcrumbs::for('admin.form.index', function (BreadcrumbTrail $trail) {
    $trail->push('Formulir Mata Pelajaran Pilihan', route('admin.form.index'));
});

Breadcrumbs::for('admin.form.preview', function (BreadcrumbTrail $trail, $tahunAkademik) {
    $trail->parent('admin.form.index');
    $trail->push($tahunAkademik->name, route('admin.form.preview', $tahunAkademik));
});

Breadcrumbs::for('admin.form.hasil', function (BreadcrumbTrail $trail, $tahunAkademik) {
    $trail->parent('admin.form.index');
    $trail->push('Hasil Pengisian Formulir ' . $tahunAkademik->name, route('admin.form.hasil', $tahunAkademik));
});

Breadcrumbs::for('admin.form.hasil.siswa', function (BreadcrumbTrail $trail, $tahunAkademik, $jawabanSiswa) {
    $trail->parent('admin.form.hasil', $tahunAkademik);
    $trail->push($jawabanSiswa->siswa->user->name, route('admin.form.hasil.siswa', [$tahunAkademik, $jawabanSiswa]));
});

Breadcrumbs::for('siswa.profile.index', function (BreadcrumbTrail $trail) {
    $trail->push('Profil', route('siswa.profile.index'));
});

Breadcrumbs::for('siswa.jadwal-mata-pelajaran.index', function (BreadcrumbTrail $trail) {
    $trail->push('Jadwal Mata Pelajaran', route('siswa.jadwal-mata-pelajaran.index'));
});

Breadcrumbs::for('siswa.jadwal-mata-pelajaran.show', function (BreadcrumbTrail $trail, $kelas) {
    $trail->parent('siswa.jadwal-mata-pelajaran.index');
    $trail->push($kelas->fullName, route('siswa.jadwal-mata-pelajaran.show', $kelas));
});

Breadcrumbs::for('siswa.modul-pembelajaran.index', function (BreadcrumbTrail $trail) {
    $trail->push('Modul Pembelajaran', route('siswa.modul-pembelajaran.index'));
});

Breadcrumbs::for('siswa.modul-pembelajaran.show', function (BreadcrumbTrail $trail, $modulPembelajaran) {
    $trail->parent('siswa.modul-pembelajaran.index');
    $trail->push($modulPembelajaran->name, route('siswa.modul-pembelajaran.show', $modulPembelajaran));
});

Breadcrumbs::for('siswa.form.index', function (BreadcrumbTrail $trail) {
    $trail->push('Formulir Mata Pelajaran Pilihan', route('siswa.form.index'));
});

Breadcrumbs::for('siswa.form.show', function (BreadcrumbTrail $trail) {
    $trail->parent('siswa.form.index');
    $trail->push('Hasil', route('siswa.form.show'));
});

Breadcrumbs::for('guru.profile.index', function (BreadcrumbTrail $trail) {
    $trail->push('Profil', route('guru.profile.index'));
});

Breadcrumbs::for('guru.modul-pembelajaran.index', function (BreadcrumbTrail $trail) {
    $trail->push('Modul Pembelajaran', route('guru.modul-pembelajaran.index'));
});

Breadcrumbs::for('guru.modul-pembelajaran.show', function (BreadcrumbTrail $trail, $modulPembelajaran) {
    $trail->parent('guru.modul-pembelajaran.index');
    $trail->push($modulPembelajaran->name, route('guru.modul-pembelajaran.show', $modulPembelajaran));
});

Breadcrumbs::for('guru.kehadiran-siswa.index', function (BreadcrumbTrail $trail) {
    $trail->push('Kehadiran Siswa', route('guru.kehadiran-siswa.index'));
});

Breadcrumbs::for('guru.kehadiran-siswa.show', function (BreadcrumbTrail $trail, $mataPelajaran) {
    $trail->parent('guru.kehadiran-siswa.index');
    $mapel = MataPelajaran::find($mataPelajaran);
    $trail->push($mapel->name, route('guru.kehadiran-siswa.show', $mataPelajaran));
});

Breadcrumbs::for('guru.form.index', function (BreadcrumbTrail $trail) {
    $trail->push('Hasil Pengisian Formulir Mata Pelajaran Pilihan', route('guru.form.index'));
});

Breadcrumbs::for('guru.form.hasil.siswa', function (BreadcrumbTrail $trail, $tahunAkademik, $jawabanSiswa) {
    $trail->parent('guru.form.index');
    $trail->push($jawabanSiswa->siswa->user->name, route('guru.form.hasil.siswa', [$tahunAkademik, $jawabanSiswa]));
});

Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->push('Profil', route('profile.edit'));
});
