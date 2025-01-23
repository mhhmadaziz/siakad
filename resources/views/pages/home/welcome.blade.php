<x-guest-layout>
    @include('layouts.home-header')
    <section
        class="min-h-60 overflow-clip bg-black/30 md:min-h-96"
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
        <div class="relative -z-10 min-h-fit w-screen md:-top-96">
            <template x-for="(slide, index) in slides" :key="index">
                <div
                    x-show="true"
                    class="absolute w-full transition-transform duration-500 ease-in-out"
                    x-bind:style="{
                        transform: `translateX(${(index - activeSlide) * 100}%)`,
                    }"
                >
                    <img
                        :src=" @js(asset('storage/carousel/')) + '/' + slide "
                        :alt="slide"
                        class="w-full object-cover object-center"
                    />
                </div>
            </template>
        </div>
    </section>

    <div class="mx-auto flex min-h-16 flex-col justify-center px-4 py-8 md:w-1/2">
        <div class="flex flex-wrap gap-2">
            <div class="mx-auto min-w-[200px] max-w-[200px] flex-1">
                <img
                    src="{{ Vite::asset('resources/images/logo.png') }}"
                    alt="logo"
                    class="h-full w-full object-contain"
                />
            </div>
            <div class="prose prose-sm prose-headings:m-0 prose-p:m-0">
                {!! $profileText !!}
            </div>
        </div>
    </div>
    <section class="px-8 py-4">
        <h1 class="mb-4 text-center text-xl font-bold">Struktur Organisasi</h1>
        <div class="flex flex-wrap justify-center gap-4">
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
