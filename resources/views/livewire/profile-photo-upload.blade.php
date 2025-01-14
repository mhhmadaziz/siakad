<div class="grid grid-cols-2 p-2">
    <div class="p-2">
        <div class="mx-auto h-56 max-w-44 bg-zinc-400">
            <img src="{{ $user?->photoUrl }}" alt="{{ $user?->name }}" class="h-full w-full object-cover" />
        </div>
    </div>
    <div class="flex w-full flex-col items-center justify-center">
        <label
            for="file-upload"
            class="flex w-full cursor-pointer items-center divide-x divide-zinc-500 rounded border border-zinc-500"
        >
            <span class="flex-1 p-2">
                @if ($user->photo)
                    {{ $user->photo }}
                @else
                    <span class="text-gray-700">Belum ada foto</span>
                @endif
            </span>
            <div class="bg-zinc-100 p-2 px-4">
                <span class="text-gray-700">Pilih Foto</span>
            </div>

            <input id="file-upload" type="file" class="sr-only" wire:model.live="photo" accept="image/*" />
        </label>

        @if (session()->has('success'))
            <div class="text-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->has('photo'))
            <span class="text-red-500">
                {{ $errors->first('photo') }}
            </span>
        @endif
    </div>
</div>
