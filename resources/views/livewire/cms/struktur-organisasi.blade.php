<div class="space-y-2">
    <h1 class="text-lg">Struktur Organisasi</h1>
    <x-alert />

    <div class="grid grid-cols-1 gap-2 rounded-md border border-zinc-300 p-2 md:grid-cols-2">
        <section class="space-y-2">
            <h2 class="text-sm">Foto Struktur Organisasi</h2>

            @if ($gambarStrukturOrganisasi)
                <div class="relative">
                    <img
                        src="{{ asset('storage/struktur-organisasi/' . $gambarStrukturOrganisasi) }}"
                        alt="struktur-organisasi"
                        class="h-72 w-full rounded-md border border-zinc-300 object-cover"
                    />
                    <button
                        wire:click="deleteImageStrukturOrganisasi"
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
            @else
                <div
                    class="relative"
                    x-data="{
                        uploading: false,
                        progress: 0,
                    }"
                    x-on:livewire-upload-start=" uploading = true; progress = 0"
                    x-on:livewire-upload-finish=" uploading = false; progress = 0 "
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress=" progress = $event.detail.progress "
                >
                    <input
                        type="file"
                        wire:model.live="uploadedStrukturOrganisasi"
                        class="hidden"
                        id="uploadedStrukturOrganisasi"
                        name="uploadedStrukturOrganisasi"
                        accept="image/*"
                    />
                    <label
                        for="uploadedStrukturOrganisasi"
                        class="flex h-72 w-full cursor-pointer flex-col items-center justify-center rounded-md border border-zinc-300"
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
            @endif
        </section>

        <section class="space-y-2">
            <h2 class="text-sm">Struktur Organisasi</h2>

            <form wire:submit="saveStrukturOrganisasi">
                <livewire:quill-text-editor wire:model="strukturOrganisasi" theme="snow" />
                <div class="mt-2 flex justify-end">
                    <button type="submit" class="rounded bg-primary px-4 py-2 text-white">Simpan</button>
                </div>
            </form>
        </section>
    </div>
</div>
