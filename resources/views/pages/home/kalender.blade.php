<x-guest-layout>
    @include('layouts.home-header')
    <section class="mx-auto max-w-screen-xl py-4">
        <h1 class="text-2xl font-bold">Kalender Akademik</h1>
        <h2 class="">Tahun Ajaran 2024/2025</h2>
        <div class="mt-4 flex w-full">
            <nav class="w-[400px]">
                <a href="{{ route('home.kalender') }}" class="font-bold">Acara</a>
                <table class="mt-2">
                    @for ($i = 0; $i < 7; $i++)
                        <tr class="">
                            <td class="pr-2">
                                <div class="h-5 w-5 bg-red-500"></div>
                            </td>
                            <td class="pr-8">Libur</td>
                            <td>7 Juli</td>
                        </tr>
                    @endfor
                </table>
            </nav>
            <section class="w-full">
                <div class="grid grid-cols-3 gap-4">
                    @for ($i = 0; $i < 24; $i++)
                        <div class="flex h-64 flex-col rounded-lg border border-zinc-200 bg-white p-2 shadow-lg">
                            <div class="h-full w-full rounded-lg bg-zinc-300"></div>
                        </div>
                    @endfor
                </div>
            </section>
        </div>
    </section>

    @include('layouts.home-footer')
</x-guest-layout>
