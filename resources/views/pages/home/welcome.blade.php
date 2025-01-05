<x-guest-layout>
    @include('layouts.home-header')
    <section class="relative min-h-96 overflow-clip bg-black/80">
        <div class="absolute -top-96 -z-10 w-full">
            <img src="{{ Vite::asset('resources/images/default-carousel.jpg') }}" alt="logo" class="object-cover" />
        </div>

        <div class="bg mx-auto flex h-96 w-1/2 flex-col justify-center">
            <div class="flex items-center gap-2">
                <div class="min-w-[200px] max-w-[200px] flex-1">
                    <img
                        src="{{ Vite::asset('resources/images/logo.png') }}"
                        alt="logo"
                        class="h-full w-full object-contain"
                    />
                </div>
                <div class="text-white">
                    <h1 class="text-4xl font-extrabold">SMA NEGERI 1</h1>
                    <h2 class="text-4xl font-extrabold">JATI AGUNG</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit, nemo impedit fugiat aperiam,
                        officia ipsa magni architecto corrupti similique voluptatibus ipsam minus provident molestiae
                        hic quos accusantium totam adipisci laboriosam! Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Odit, nemo impedit fugiat aperiam, officia ipsa magni architecto corrupti
                        laboriosam!
                    </p>
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <a href="{{ route('login') }}">
                    <button class="rounded-md bg-white px-8 py-2 font-semibold uppercase text-blue-800">Masuk</button>
                </a>
            </div>
        </div>
    </section>
    <section class="px-8 py-4">
        <h1 class="mb-4 text-center text-xl font-bold">Struktur Organisasi</h1>
        <div class="flex justify-center gap-4">
            <div class="w-[600px] bg-zinc-600"></div>
            <div class="w-[400px] bg-primary p-4 text-white">
                <ul class="space-y-4">
                    @for ($i = 0; $i < 5; $i++)
                        <li class="">
                            <p class="text-xs leading-none">
                                Kepala Sekolah
                                <span class="block text-lg font-bold">John Doe</span>
                            </p>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </section>

    @include('layouts.home-footer')
</x-guest-layout>
