<div class="">
    <h1>
        @if (session('success'))
            <div class="rounded bg-green-500 p-2 text-white">
                {{ session('success') }}
            </div>
        @endif
    </h1>

    <h1>
        @if (session('error'))
            <div class="rounded bg-red-500 p-2 text-white">
                {{ session('error') }}
            </div>
        @endif
    </h1>
</div>
