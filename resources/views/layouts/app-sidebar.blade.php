<section>
    <nav class="w-[250px]">
        <ul class="space-y-4">
            @foreach ($menuData->dashboard as $menu)
                @isset($menu->role)
                    @if (! auth()->user()->hasAnyRole($menu->role))
                        @continue
                    @endif
                @endisset

                @php
                    $isActive = in_array(Route::currentRouteName(), $menu->slug);
                @endphp

                <li @class(['px-3 py-2 pr-8 text-sm', 'bg-white' => $isActive])>
                    <a href="{{ route($menu->route) }}" class="flex items-center gap-2 hover:underline">
                        <i class="{{ $menu->icon }} w-6 text-sm text-primary"></i>
                        {{ $menu->label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</section>
