<div class="space-y-2">
    <h1 class="text-lg">Kalender</h1>
    <x-alert />

    <div
        class="rounded-md border border-zinc-300 p-2"
        x-data="{
            uploading: false,
            progress: 0,
        }"
        x-on:livewire-upload-start="uploading = true; progress = 0"
        x-on:livewire-upload-finish="uploading = false; progress = 0"
        x-on:livewire-upload-cancel="uploading = false"
        x-on:livewire-upload-error="uploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        @if ($kalender)
            <div class="relative mx-auto max-w-screen-sm">
                <button class="absolute right-2 top-2 rounded-full bg-red-500 p-1 text-white" wire:click="deleteImage">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
                <img
                    id="preview"
                    src="{{ asset('storage/kalender/' . $kalender) }}"
                    alt="kalender"
                    class="h-full w-full rounded-md border border-zinc-300 object-cover"
                />
            </div>
        @else
            <input
                type="file"
                name="kalender"
                id="kalender"
                class="sr-only"
                accept="image/png, image/jpeg, image/jpg"
                wire:model.live="newImage"
            />
            <label
                for="kalender"
                class="flex min-h-44 w-full cursor-pointer flex-col items-center justify-center rounded-md border border-zinc-300"
            >
                <span class="text-gray-700" x-text="uploading ? 'Mengunggah...' : 'Pilih Foto'"></span>

                <!-- Progress Bar -->
                <div x-show="uploading">
                    <progress max="100" min="0" x-bind:value="progress" value="0"></progress>
                </div>
            </label>

            @error('newImage')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        @endif
    </div>
</div>
