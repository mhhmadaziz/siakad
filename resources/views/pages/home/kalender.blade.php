<x-guest-layout>
    @include('layouts.home-header')
    <section class="mx-auto min-h-screen max-w-screen-xl p-4">
        <h1 class="text-2xl font-bold">Kalender Akademik</h1>
        <h2 class="">Tahun Ajaran 2024/2025</h2>
        <div class="mt-4 flex w-full flex-col gap-2 md:flex-row">
            <nav class="w-[400px]">
                <a href="{{ route('home.kalender') }}" class="font-bold">Acara</a>
                <div class="prose prose-sm prose-headings:m-0 prose-p:m-0">{!! $kalenderText !!}</div>
            </nav>
            <section class="flex min-h-screen w-full justify-end">
                @if ($kalender)
                    <div class="max-w-screen-sm rounded-md border border-zinc-300 p-2">
                        <img src="{{ asset('storage/kalender/' . $kalender) }}" alt="kalender" />
                    </div>
                @endif
            </section>
        </div>
    </section>

    @include('layouts.home-footer')
</x-guest-layout>
