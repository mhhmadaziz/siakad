<x-guest-layout>
    @include('layouts.auth-header')

    <section class="mx-auto my-8 w-[600px] rounded-md border border-zinc-300 p-8 shadow-md" x-data>
        <div class="">
            <h1 class="text-center font-semibold">SIAKAD SMA N 1 JATI AGUNG</h1>
            <h2 class="text-center">Masuk</h2>

            <x-auth-session-status class="my-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mx-auto w-96 space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        class="block w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        autofocus
                        placeholder="Masukan email"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4" x-data="{ showPassword: false }">
                    <x-input-label for="password" :value="__('Kata Sandi')" />

                    <x-text-input
                        id="password"
                        class="block w-full"
                        x-bind:type="showPassword ? 'text' : 'password'"
                        name="password"
                        required
                        placeholder="Masukan Kata Sandi"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <!--checkbox untuk tampilkan password-->
                    <div class="mt-2 flex items-center">
                        <input
                            type="checkbox"
                            class="h-4 w-4 border-2 border-primary text-primary"
                            id="show-password"
                            x-on:click="showPassword = !showPassword"
                        />
                        <label for="show-password" class="ml-2 text-sm text-gray-600">Tampilkan Kata Sandi</label>
                    </div>
                </div>

                <div class="mt-4 flex flex-col space-y-2 text-center">
                    <button class="w-full rounded-md bg-primary py-2 font-semibold text-white">MASUK</button>
                    <span class="text-sm">atau</span>
                    <div>
                        <a class="rounded-md text-sm text-red-500 underline" href="{{ route('password.request') }}">
                            {{ __('Reset Kata sandi') }}
                        </a>
                        |
                        <a class="rounded-md text-sm underline" href="{{ route('register') }}">Daftar Sekarang</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('layouts.auth-footer')
</x-guest-layout>
