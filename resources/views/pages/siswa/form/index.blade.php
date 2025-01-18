<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="mb-8 rounded border border-zinc-300 p-2">
            <h1 class="mb-2 font-semibold">FORMULIR MATA PELAJARAN PILIHAN</h1>

            <form class="space-y-4" action="{{ route('siswa.form.submit') }}" method="POST">
                @csrf
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
                                    name="pertanyaan_{{ $pertanyaan->id }}"
                                    id="pertanyaan_{{ $pertanyaan->id }}"
                                    placeholder="Masukan jawaban"
                                    class="mt-2 h-24 w-full rounded-md border border-zinc-300 px-2 py-1 outline-none focus:border-zinc-500"
                                >
{{ old('pertanyaan_' . $pertanyaan->id) }}
                                </textarea>

                                @break
                            @case('radio')
                                @foreach ($pertanyaan->decodedOpsi as $opsi)
                                    <div class="mt-2 flex items-center">
                                        <input
                                            type="radio"
                                            name="pertanyaan_{{ $pertanyaan->id }}"
                                            id="{{ $opsi['value'] }}"
                                            class="mr-2"
                                            value="{{ $opsi['label'] }}"
                                            {{ old('pertanyaan_' . $pertanyaan->id) === $opsi['label'] ? 'checked' : '' }}
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
                                            name="pertanyaan_{{ $pertanyaan->id }}[]"
                                            id="{{ $opsi['value'] }}"
                                            class="mr-2"
                                            value="{{ $opsi['label'] }}"
                                            {{
                                                is_array(old('pertanyaan_' . $pertanyaan->id)) &&
                                                in_array($opsi['label'], old('pertanyaan_' . $pertanyaan->id))
                                                    ? 'checked'
                                                    : ''
                                            }}
                                        />
                                        <label for="{{ $opsi['value'] }}">{{ $opsi['label'] }}</label>
                                    </div>
                                @endforeach

                                @break
                            @default
                                <input
                                    type="{{ $pertanyaan->tipeInput }}"
                                    name="pertanyaan_{{ $pertanyaan->id }}"
                                    placeholder="Masukan jawaban"
                                    value="{{ old('pertanyaan_' . $pertanyaan->id) }}"
                                    class="mt-2 w-full rounded-md border border-zinc-300 px-2 py-1 outline-none focus:border-zinc-500"
                                />
                        @endswitch

                        <x-input-error :messages="$errors->get('pertanyaan_' . $pertanyaan->id)" class="mt-2" />
                    </div>
                @endforeach

                <div class="flex justify-end">
                    <button class="rounded-md bg-black px-4 py-2 text-white">Kirim</button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
