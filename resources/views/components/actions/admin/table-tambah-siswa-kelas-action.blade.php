<div>
    <button
        class="rounded-md bg-black px-4 py-2 text-white disabled:bg-black/50"
        wire:click="tambahSiswaKelas"
        {{ count($this->selected) == 0 ? 'disabled' : '' }}
    >
        Tambah Siswa
    </button>
</div>
