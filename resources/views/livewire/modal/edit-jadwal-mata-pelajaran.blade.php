<div class="p-4">
    <h1 class="text-2xl font-semibold">Edit Jadwal</h1>

    <form class="mt-4 space-y-2" wire:submit="submit">
        <div class="flex flex-col gap-2">
            <label for="">Mata Pelajaran</label>
            <x-inputs.text
                name="mataPelajaranId"
                :value="$jadwalMataPelajaran?->mataPelajaran?->name"
                :disabled="true"
            />
        </div>

        <div class="flex gap-2">
            <div class="flex flex-1 flex-col">
                <label for="jamMulai">Jam Mulai</label>
                <input type="time" name="jamMulai" id="jamMulai" wire:model="jamMulai" />

                @error('jamMulai')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-1 flex-col">
                <label for="">Jam Selesai</label>
                <input type="time" name="jamSelesai" id="jamMulai" wire:model="jamSelesai" />

                @error('jamSelesai')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex w-full justify-end">
            <button class="bg-blue-600 px-4 py-2 text-white">Simpan</button>
        </div>
    </form>
</div>
