<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">ATURAN & KEBIJAKAN</h1>

            <div class="flex flex-wrap items-center justify-between rounded-lg bg-primary p-3 py-6">
                <div class="flex gap-2 text-white">
                    <i class="fa-solid fa-graduation-cap text-6xl"></i>
                    <div class="flex w-full items-center justify-between">
                        <div class="">
                            <h2>
                                Tahun Ajaran

                                @if ($currentTahunAkademik->id == $tahunAkademik->id)
                                    <span class="rounded-full bg-green-600 px-4 py-1 text-sm">Aktif</span>
                                @endif
                            </h2>
                            <h1 class="text-3xl font-semibold">{{ $tahunAkademik->name }}</h1>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.tahun-akademik.edit', $tahunAkademik->id) }}">
                        <button class="rounded-md bg-yellowCustom px-4 py-2">Edit</button>
                    </a>
                    <form
                        action="{{ route('admin.tahun-akademik.import-data', $tahunAkademik->id) }}"
                        method="post"
                        enctype="multipart/form-data"
                        x-data
                        x-ref="form"
                    >
                        @csrf
                        <label for="importdata" class="cursor-pointer rounded-md bg-green-600 px-4 py-2 text-white">
                            <input
                                type="file"
                                id="importdata"
                                name="file"
                                class="sr-only"
                                x-on:change="$refs.form.submit()"
                                accept=".xlsx"
                            />
                            Import Data
                        </label>
                    </form>
                    <a href="{{ route('admin.siswa.export-template.download') }}">
                        <button class="rounded-md bg-yellowCustom px-4 py-2">Download template</button>
                    </a>
                </div>
            </div>

            <div class="divide-y divide-zinc-300 rounded border border-zinc-300" x-data>
                <div class="flex items-center justify-between p-2">
                    <h1>PPDB</h1>
                    <div class="flex flex-wrap items-center justify-end gap-2 text-white">
                        @if ($tahunAkademik->file_ppdb)
                            <a
                                href="{{
                                    route('pdf.download', urlencode('ppdb/' . $tahunAkademik->file_ppdb)) .
                                        '?name=' .
                                        urlencode('PPDB ' . Str::of($tahunAkademik->name)->replace('/', '-'))
                                }}"
                            >
                                <button class="rounded-md bg-black px-4 py-2">UNDUH</button>
                            </a>

                            <form
                                action="{{ route('admin.tahun-akademik.upload-ppdb', $tahunAkademik->id) }}"
                                method="post"
                                enctype="multipart/form-data"
                                x-ref="form"
                            >
                                @csrf

                                <label for="file" class="cursor-pointer">
                                    <input
                                        type="file"
                                        name="file"
                                        id="file"
                                        class="sr-only"
                                        accept=".pdf"
                                        x-on:change="$refs.form.submit()"
                                        x-ref="file"
                                    />
                                    <button
                                        class="rounded-md bg-yellowCustom px-4 py-2 text-black"
                                        x-on:click.prevent="$refs.file.click()"
                                    >
                                        UNGGAH BARU
                                    </button>
                                </label>
                            </form>

                            <a href="{{ route('admin.tahun-akademik.ppdb', $tahunAkademik->id) }}">
                                <button class="rounded-md bg-primary px-4 py-2">LIHAT</button>
                            </a>
                        @else
                            <form
                                action="{{ route('admin.tahun-akademik.upload-ppdb', $tahunAkademik->id) }}"
                                method="post"
                                enctype="multipart/form-data"
                                x-ref="formNew"
                            >
                                @csrf

                                <label for="file" class="cursor-pointer">
                                    <input
                                        type="file"
                                        name="file"
                                        id="file"
                                        class="sr-only"
                                        accept=".pdf"
                                        x-on:change="$refs.formNew.submit()"
                                        x-ref="fileNew"
                                    />
                                    <button
                                        class="rounded-md bg-yellowCustom px-4 py-2 text-black"
                                        x-on:click.prevent="$refs.fileNew.click()"
                                    >
                                        UNGGAH
                                    </button>
                                </label>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between p-2">
                    <h1>Kelas</h1>
                    <div class="flex justify-end gap-2 text-white">
                        <a href="{{ route('admin.tahun-akademik.kelas', $tahunAkademik->id) }}">
                            <button class="rounded-md bg-primary px-4 py-2">LIHAT</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
