<x-guest-layout>
    @include('layouts.auth-header')

    <form
        method="POST"
        action="{{ route('password.email') }}"
        class="mx-auto my-8 rounded-md border border-zinc-300 p-8 shadow-md md:w-[600px]"
    >
        @csrf

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="mb-4 text-sm text-gray-600">
            Silahkan masukkan alamat email Anda, kami akan mengirimkan tautan untuk mereset kata sandi Anda.
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-end">
            <x-primary-button>Kirim</x-primary-button>
        </div>
    </form>

    @include('layouts.auth-footer')
</x-guest-layout>
