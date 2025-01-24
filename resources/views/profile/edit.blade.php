<x-app-layout>
    <div class="mx-auto min-h-screen w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="mx-auto min-h-screen max-w-screen-sm space-y-8 rounded border border-zinc-300 p-2">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
        </div>
    </div>
</x-app-layout>
