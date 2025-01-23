<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="mb-8 rounded border border-zinc-300 p-2">
            <h1 class="mb-2 font-semibold">PREVIEW FORMULIR MATA PELAJARAN PILIHAN</h1>

            <section class="space-y-4">
                @foreach ($pertanyaans as $pertanyaan)
                    <div class="rounded-md border border-zinc-300 p-2">
                        <p class="font-semibold">
                            {{ $loop->iteration }}. {{ $pertanyaan->pertanyaan }}
                            @if ($pertanyaan->required)
                                <span class="text-red-500">*</span>
                            @endif
                        </p>

                        @switch($pertanyaan->tipeInput)
                            @case('textarea')
                                <textarea
                                    name=""
                                    id=""
                                    placeholder="Masukan jawaban"
                                    class="mt-2 h-24 w-full rounded-md border border-zinc-300 px-2 py-1 outline-none focus:border-zinc-500"
                                ></textarea>

                                @break
                            @case('radio')
                                @foreach ($pertanyaan->decodedOpsi as $opsi)
                                    <div class="mt-2 flex items-center">
                                        <input
                                            type="radio"
                                            name="{{ $pertanyaan->id }}"
                                            id="{{ $opsi['value'] }}"
                                            class="mr-2"
                                            value="{{ $opsi['value'] }}"
                                        />
                                        <label for="{{ $opsi['value'] }}">{{ $opsi['label'] }}</label>
                                    </div>
                                @endforeach

                                @break
                            @case('checkbox')
                                @foreach ($pertanyaan->decodedOpsi as $opsi)
                                    <div class="mt-2 flex items-center">
                                        <input
                                            type="checkbox"
                                            name="{{ $opsi['value'] }}"
                                            id="{{ $opsi['value'] }}"
                                            class="mr-2"
                                        />
                                        <label for="{{ $opsi['value'] }}">{{ $opsi['label'] }}</label>
                                    </div>
                                @endforeach

                                @break
                            @default
                                <input
                                    type="{{ $pertanyaan->tipeInput }}"
                                    placeholder="Masukan jawaban"
                                    class="mt-2 w-full rounded-md border border-zinc-300 px-2 py-1 outline-none focus:border-zinc-500"
                                />
                        @endswitch
                    </div>
                @endforeach

                <div class="flex justify-end">
                    <button class="rounded-md bg-black px-4 py-2 text-white">Kirim</button>
                </div>
            </section>
        </div>
    </section>
</x-app-layout>
