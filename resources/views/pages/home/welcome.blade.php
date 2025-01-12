<x-guest-layout>
    @include('layouts.home-header')
    <section
        class="relative min-h-96 overflow-clip bg-black/80"
        x-data="{
            activeSlide: 0,
            autoSlideInterval: null,
            slides: @js($carousels),
            interval: null,
        }"
        x-init="
            interval = setInterval(() => {
                activeSlide = (activeSlide + 1) % slides.length
            }, 4000)
        "
    >
        <div class="absolute -top-96 -z-10 w-screen">
            <template x-for="(slide, index) in slides" :key="index">
                <div
                    x-show="true"
                    class="absolute left-0 top-0 transition-transform duration-500 ease-in-out"
                    style="width: 100%"
                    x-bind:style="{
                        transform: `translateX(${(index - activeSlide) * 100}%)`,
                    }"
                >
                    <img :src=" @js(asset('storage/carousel/')) + '/' + slide " :alt="slide" class="w-full" />
                </div>
            </template>
            {{-- <img src="{{ Vite::asset('resources/images/default-carousel.jpg') }}" alt="logo" class="w-screen" /> --}}
        </div>

        <div class="bg mx-auto flex h-96 w-1/2 flex-col justify-center">
            <div class="flex gap-2">
                <div class="min-w-[200px] max-w-[200px] flex-1">
                    <img
                        src="{{ Vite::asset('resources/images/logo.png') }}"
                        alt="logo"
                        class="h-full w-full object-contain"
                    />
                </div>
                <div class="prose prose-sm prose-invert prose-headings:m-0 prose-p:m-0">
                    {!! $profileText !!}
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
            <div class="h-72 w-[600px] border border-zinc-300 bg-zinc-600">
                @if ($gambarStrukturOrganisasi)
                    <img
                        src="{{ asset('storage/struktur-organisasi/' . $gambarStrukturOrganisasi) }}"
                        alt="struktur-organisasi"
                        class="h-full w-full object-cover"
                    />
                @else
                    <img
                        src="https://placehold.co/600x400"
                        alt="struktur-organisasi"
                        class="h-full w-full object-cover"
                    />
                @endif
            </div>
            <div class="prose prose-sm prose-invert w-[400px] bg-primary p-4 text-white prose-headings:m-0 prose-p:m-0">
                {!! $strukturOrganisasi !!}
            </div>
        </div>
    </section>

    @include('layouts.home-footer')
</x-guest-layout>
