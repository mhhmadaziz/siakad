<section>
    <nav class="w-[250px]">
        <ul class="space-y-4">
            @foreach ($dashboardMenu as $menu)
                <li
                    @class(['px-3 py-2 pr-8 text-sm', 'bg-white' => Route::is($menu['route'])])
                >
                    <a href="{{ route($menu['route']) }}" class="flex items-center gap-2 hover:underline">
                        <i class="{{ $menu['icon'] }} text-sm text-primary"></i>
                        {{ $menu['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</section>
