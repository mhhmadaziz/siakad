<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-4 rounded border border-zinc-300 p-2">
            <h1 class="text-xl font-semibold">Kalender</h1>

            <livewire:cms.kalender-text-editor wire:key="kalender-table" />
            <livewire:cms.kalender-upload wire:key="kalender-upload" />
        </div>
    </section>
</x-app-layout>
