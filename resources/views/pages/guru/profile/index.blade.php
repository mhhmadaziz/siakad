<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">EDIT INFORMASI AKUN</h1>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form
                class="grid divide-y divide-zinc-300 rounded-md border border-zinc-300 md:grid-cols-2"
                method="POST"
                action="{{ route('guru.profile.update.akun') }}"
            >
                @csrf
                @method('PATCH')

                <div class="flex items-center p-2">
                    <label for="">Email</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <input
                        class="w-full rounded disabled:opacity-50"
                        autocomplete="off"
                        type="email"
                        name="email"
                        value="{{ old('email', $guru->user->email) }}"
                    />
                    <x-input-error :messages="$errors->updateAkun->get('email')" class="mt-2" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="mt-2 text-sm text-gray-800">
                                Email anda belum terverifikasi.

                                <button
                                    form="send-verification"
                                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >
                                    Klik disini untuk mengirim ulang email verifikasi.
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-sm font-medium text-green-600">
                                    Email verifikasi telah dikirim ulang ke alamat email anda.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="p-2 md:col-span-2">
                    <span class="text-red-500">Hanya diisi jika ingin mengganti password</span>
                </div>
                <div class="flex items-center p-2">
                    <label for="">Password Lama</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <input
                        class="w-full rounded disabled:opacity-50"
                        autocomplete="off"
                        type="password"
                        name="old_password"
                    />
                    <x-input-error :messages="$errors->updateAkun->get('old_password')" class="mt-2" />
                </div>
                <div class="flex items-center p-2">
                    <label for="">Password Baru</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <input
                        class="w-full rounded disabled:opacity-50"
                        autocomplete="off"
                        type="password"
                        name="password"
                    />

                    <x-input-error :messages="$errors->updateAkun->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center p-2">
                    <label for="">Ulangi Password Baru</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <input
                        class="w-full rounded disabled:opacity-50"
                        autocomplete="off"
                        type="password"
                        name="password_confirmation"
                    />
                    <x-input-error :messages="$errors->updateAkun->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-2 p-2 md:col-span-2">
                    <button class="rounded bg-green-600 px-4 py-2 font-semibold text-white" type="submit">
                        SIMPAN
                    </button>
                </div>
            </form>

            <h1 class="font-semibold">EDIT DATA DIRI SISWA</h1>

            <form
                class="grid divide-y divide-zinc-300 rounded-md border border-zinc-300 md:grid-cols-2"
                action="{{ route('guru.profile.update') }}"
                method="POST"
            >
                @csrf
                @method('PATCH')

                <div class="md:col-span-2">
                    <livewire:profile-photo-upload :user="$guru->user" />
                </div>

                @foreach ($forms as $item)
                    <div class="flex items-center p-2">
                        <label for="{{ $item->name }}">
                            {{ $item->label }}
                        </label>
                    </div>
                    <div class="flex flex-col justify-center p-2">
                        @if ($item->type === 'select')
                            <select
                                class="w-full rounded disabled:opacity-50"
                                name="{{ $item->name }}"
                                {{ $item->required ? 'required' : '' }}
                                {{ $item->disabled ? 'disabled' : '' }}
                            >
                                @foreach ($item->options as $option)
                                    <option
                                        value="{{ $option->value }}"
                                        {{ $option->label == $item->value ? 'selected' : '' }}
                                    >
                                        {{ $option->label }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif ($item->type === 'textarea')
                            <textarea
                                class="w-full rounded disabled:opacity-50"
                                name="{{ $item->name }}"
                                {{ $item->required ? 'required' : '' }}
                                {{ $item->disabled ? 'disabled' : '' }}
                            >
{{ old($item->name, $item->value) }} </textarea
                            >
                        @else
                            <input
                                class="w-full rounded disabled:opacity-50"
                                autocomplete="off"
                                type="{{ $item->type }}"
                                name="{{ $item->name }}"
                                value="{{ old($item->name, $item->value) }}"
                                {{ $item->required ? 'required' : '' }}
                                {{ $item->disabled ? 'disabled' : '' }}
                            />
                        @endif
                        @if ($errors->has($item->name))
                            <span class="text-red-500">
                                {{ $errors->first($item->name) }}
                            </span>
                        @endif
                    </div>
                @endforeach

                <div></div>
                <div class="flex justify-end gap-2 p-2">
                    <button class="rounded bg-green-600 px-4 py-2 font-semibold text-white" type="submit">
                        SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
