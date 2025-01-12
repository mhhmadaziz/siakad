<div class="space-y-2">
    <h1 class="text-lg">Carousel</h1>
    <x-alert />

    <div class="grid grid-cols-4 gap-2 rounded-md border border-zinc-300 p-2">
        @foreach ($carousels as $item)
            <div class="relative">
                <img
                    src="{{ asset('storage/carousel/' . $item) }}"
                    alt="carousel"
                    class="h-32 w-full rounded-md border border-zinc-300 object-cover"
                />
                <button
                    wire:click="deleteImage('{{ $item }}')"
                    wire:confirm="Apakah anda yakin?"
                    class="absolute right-2 top-2 rounded-full bg-red-500 p-1 text-white"
                >
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
            </div>
        @endforeach

        <div
            class="relative"
            x-data="{
                uploading: false,
                progress: 0,
            }"
            x-on:livewire-upload-start="
                uploading = true
                progress = 0
            "
            x-on:livewire-upload-finish="
                uploading = false
                progress = 0
            "
            x-on:livewire-upload-cancel="uploading = false"
            x-on:livewire-upload-error="uploading = false"
            x-on:livewire-upload-progress="
                progress = $event.detail.progress
            "
        >
            <input
                type="file"
                wire:model.live="newImage"
                class="hidden"
                id="newImage"
                accept="image/png, image/jpeg, image/jpg"
            />
            <label
                for="newImage"
                class="flex h-32 w-full cursor-pointer flex-col items-center justify-center rounded-md border border-zinc-300"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 text-zinc-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                </svg>

                <!-- Progress Bar -->
                <div x-show="uploading">
                    <progress max="100" min="0" x-bind:value="progress" value="0"></progress>
                </div>
            </label>
        </div>
    </div>
</div>
