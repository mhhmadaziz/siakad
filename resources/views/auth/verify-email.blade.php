<x-guest-layout>
    @include('layouts.auth-header')
    <section class="mx-auto my-8 w-[600px] rounded-md border border-zinc-300 p-8 shadow-md">
        <h1 class="mb-4 text-center text-xl font-semibold text-primary">REGISTRASI BERHASIL</h1>
        <div class="mb-4 text-sm text-gray-600">
            Tautan verifikasi telah dikirimkan melalui kotak masuk email
            <span class="font-semibold">{{ auth()->user()->email }}</span>
            . Silahkan periksa kotak masuk email Anda atau periksa pada folder spam.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ __('Email verifikasi berhasil dikirim') }}
            </div>
        @endif

        <div class="mt-4 flex items-center gap-2">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button class="rounded-md bg-primary px-4 py-2 text-white">Kirim ulang email verifikasi</button>
                </div>
            </form>

            <span>Atau</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </section>

    @include('layouts.auth-footer')
</x-guest-layout>
