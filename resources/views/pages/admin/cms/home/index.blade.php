<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-4 rounded border border-zinc-300 p-2">
            <h1 class="text-xl font-semibold">Beranda</h1>
            <livewire:cms.profile-text-editor wire:key="profile-text-editor" />
            <livewire:cms.carousel-editor wire:key="carousel-editor" />
            <livewire:cms.struktur-organisasi wire:key="struktur-organisasi" />
        </div>
    </section>
</x-app-layout>
