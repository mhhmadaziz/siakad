<x-guest-layout>
    @include('layouts.auth-header')
    <section
        class="mx-auto my-8 w-[600px] rounded-md border border-zinc-300 p-8 shadow-md"
        x-data="{
            showPassword: false,
        }"
    >
        <h1 class="text-center text-xl font-semibold text-primary">PENDAFTARAN</h1>
        <h1 class="text-center text-primary">SIAKAD SMA N 1 JATI AGUNG</h1>

        <form method="POST" action="{{ route('register') }}" class="mx-auto w-96 space-y-4">
            @csrf

            <div>
                <x-input-label for="name" :value="__('NISN/NIP/NUPTK')" />
                <x-text-input
                    id="name"
                    class="mt-1 block w-full"
                    type="text"
                    name="identifier"
                    :value="old('identifier')"
                    required
                    placeholder="Masukan NISN/NIP/NUPTK"
                />
                <x-input-error :messages="$errors->get('identifier')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input
                    id="email"
                    class="mt-1 block w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username"
                    placeholder="Masukan Email"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Kata Sandi')" />

                <x-text-input
                    id="password"
                    class="mt-1 block w-full"
                    x-bind:type="showPassword ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Masukan Kata Sandi"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Ulangi Kata Sandi')" />

                <x-text-input
                    id="password_confirmation"
                    class="mt-1 block w-full"
                    x-bind:type="showPassword ? 'text' : 'password'"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Ulangi Kata Sandi"
                />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

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

            <div class="flex flex-col items-center justify-end gap-2">
                <button class="w-full rounded-md bg-primary py-2 font-semibold text-white">DAFTAR</button>
                <span>Atau</span>
                <a href="{{ route('login') }}" class="underline">Login</a>
            </div>
        </form>
    </section>

    @include('layouts.auth-footer')
</x-guest-layout>
