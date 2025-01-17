<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pb-16 pt-4 text-black">
        <div class="flex justify-between rounded-lg bg-primary p-4 text-white">
            <div>
                <h1 class="text-2xl">Selamat Datang</h1>
                <h2 class="text-2xl">{{ auth()->user()->name }} !</h2>

                <p class="mt-4">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>

            <div class="flex flex-col text-right font-semibold">
                <h1>Sistem Informasi Akademik</h1>
                <h1>SMA Negeri 1 Jati Agung</h1>
                <h1 class="mt-8">Tahun Akademik {{ $currentTahunAkademik?->name ?? '' }}</h1>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6">
            @foreach ($countCard as $key => $item)
                <div class="flex items-center rounded-lg bg-zinc-100 p-6">
                    <div class="flex-1">
                        <h1 class="text-md">{{ $key }}</h1>
                        <h2 class="text-4xl font-semibold">{{ $item->count }}</h2>
                    </div>
                    <div>
                        <i class="{{ $item->icon }} text-8xl text-zinc-400"></i>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Panel Statistik Siswa -->
            <div class="rounded-lg bg-zinc-100 p-4">
                <h2 class="mb-4 text-center text-xl font-semibold">Informasi Statistik Siswa</h2>
                <div class="flex">
                    <div class="w-full">
                        <canvas id="siswaChart" width="150" height="150"></canvas>
                    </div>
                    <div class="w-full">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left">
                                    <th class="py-2">Label</th>
                                    <th class="py-2">Value</th>
                                    <th class="py-2">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistikSiswa as $item)
                                    <tr>
                                        <td class="py-2">{{ $item['label'] }}</td>
                                        <td class="py-2">{{ $item['count'] }}</td>
                                        <td class="py-2">{{ $item['percentage'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Panel Statistik Guru -->
            <div class="rounded-lg bg-zinc-100 p-4">
                <h2 class="mb-4 text-center text-xl font-semibold">Informasi Statistik Guru</h2>
                <div class="flex">
                    <div class="w-full">
                        <canvas id="guruChart" width="150" height="150"></canvas>
                    </div>
                    <div class="w-full">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left">
                                    <th class="py-2">Label</th>
                                    <th class="py-2">Value</th>
                                    <th class="py-2">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistikGuru as $item)
                                    <tr>
                                        <td class="py-2">{{ $item['label'] }}</td>
                                        <td class="py-2">{{ $item['count'] }}</td>
                                        <td class="py-2">{{ $item['percentage'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Kelulusan Siswa -->

        <div class="w-full rounded-md bg-zinc-100 p-4">
            <h2 class="mb-4 text-xl font-semibold">Grafik Penerimaan</h2>

            <canvas id="kelulusanChart" width="400" height="100"></canvas>
        </div>
    </section>

    @push('scripts')
        <script type="module">
            // Chart Siswa
            const ctxSiswa = document.getElementById('siswaChart').getContext('2d');
            const siswaChart = new Chart(ctxSiswa, {
                type: 'doughnut',
                data: {
                    labels: @json($statistikSiswa->pluck('label')),
                    datasets: [
                        {
                            label: 'Statistik Siswa',
                            data: @json($statistikSiswa->pluck('count')),
                            backgroundColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)'],
                            hoverOffset: 4,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            });

            // Chart Guru
            const ctxGuru = document.getElementById('guruChart').getContext('2d');
            const guruChart = new Chart(ctxGuru, {
                type: 'doughnut',
                data: {
                    labels: @json($statistikGuru->pluck('label')),
                    datasets: [
                        {
                            label: 'Statistik Guru',
                            data: @json($statistikGuru->pluck('count')),
                            backgroundColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)'],
                            hoverOffset: 4,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            });

            // Chart Kelulusan
            const ctxKelulusan = document.getElementById('kelulusanChart').getContext('2d');
            const labels = @json($siswaKelas10->pluck('label'));
            const data = @json($siswaKelas10->pluck('count'));
            const kelulusanChart = new Chart(ctxKelulusan, {
                type: 'bar', //tetap bar
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Penerimaan Siswa',
                            data: data,
                            backgroundColor: 'rgb(54, 162, 235)',
                            borderColor: 'rgb(54, 162, 235)',
                            borderWidth: 1,
                            barThickness: 20,
                        },
                    ],
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        y: {
                            categoryPercentage: 0.8,
                        },
                    },
                },
            });
        </script>
    @endpush
</x-app-layout>
