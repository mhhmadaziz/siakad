<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="mb-4 min-h-screen space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="mb-2 font-semibold">
                HASIL FORMULIR MATA PELAJARAN PILIHAN
                {{ $jawabanSiswa->tahunAkademik->name }}
            </h1>

            @foreach ($jawabanSiswa->jawabans as $jawaban)
                <div class="flex gap-2 rounded-md border border-zinc-300 p-2">
                    <div>{{ $loop->iteration }}.</div>
                    <div>
                        <p class="font-semibold">
                            {{ $jawaban->pertanyaan->pertanyaan }}
                            @if ($jawaban->pertanyaan->required)
                                <span class="text-red-500">*</span>
                            @endif
                        </p>
                        <p>
                            Jawaban :

                            @if ($jawaban->pertanyaan->tipeInput === 'checkbox')
                                @foreach ($jawaban->decodedJawaban as $item)
                                    {{ $item }}{{ $loop->last ? '' : ', ' }}
                                @endforeach
                            @else
                                {{ $jawaban->jawaban }}
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
