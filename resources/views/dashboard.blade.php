<x-layouts::app :title="__('Dashboard')">
    
    {{-- =========================================================
        AMBIENT BACKGROUND GLOW
    ========================================================== --}}
    <div class="fixed inset-0 z-[-1] bg-gradient-to-br from-[#bae6fd] via-[#e0f2fe] to-[#a5f3fc] dark:from-[#020617] dark:via-[#0f172a] dark:to-[#083344] pointer-events-none overflow-hidden">
        <div class="absolute -top-[20%] -left-[10%] w-[70vw] h-[70vw] max-w-[800px] max-h-[800px] rounded-full bg-cyan-500/20 blur-[120px] dark:bg-cyan-900/30"></div>
        <div class="absolute -bottom-[20%] -right-[10%] w-[60vw] h-[60vw] max-w-[600px] max-h-[600px] rounded-full bg-sky-500/20 blur-[120px] dark:bg-sky-900/30"></div>
    </div>

    <div class="relative mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-6 pb-8 z-0">

        {{-- =========================================================
            HEADER DASHBOARD (Ukuran disamakan dengan Monitoring)
        ========================================================== --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#111827] to-[#0b334d] px-6 py-8 text-white shadow-xl sm:px-10">
            <div class="pointer-events-none absolute -right-12 -top-16 size-48 rounded-full border-[18px] border-white/5"></div>
            
            <div class="relative z-10">
                <div class="mb-2 flex items-center gap-2 text-cyan-400">
                    <flux:icon name="home" class="size-4" />
                    <span class="text-xs font-bold uppercase tracking-[0.2em]">Ringkasan Sistem</span>
                </div>
                <flux:heading size="xl" class="text-white font-bold tracking-tight">Dashboard</flux:heading>
                <div class="mt-3 flex items-center gap-4">
                    <flux:text class="text-slate-300 max-w-xl text-sm leading-relaxed">
                        Pantau kondisi armada, masa berlaku pajak, dan statistik operasional kendaraan secara real-time.
                    </flux:text>
                    <div class="hidden sm:flex items-center gap-2 ml-auto rounded-full bg-white/10 backdrop-blur-sm px-4 py-2 border border-white/10">
                        <flux:icon name="calendar" class="size-4 text-cyan-300" />
                        <span class="text-sm font-medium text-cyan-100">
                            {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================================================
            STATISTIK KARTU
        ========================================================== --}}
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4 relative z-10">

            {{-- TOTAL KENDARAAN --}}
            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-lg shadow-slate-200/50 border border-slate-100 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl hover:shadow-sky-900/10 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">
                <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl bg-gradient-to-r from-sky-400 to-cyan-500"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="relative flex size-16 shrink-0 items-center justify-center rounded-2xl bg-slate-50 dark:bg-slate-800/50 transition-transform duration-300 group-hover:scale-110 group-hover:-translate-y-0.5">
                        <img src="{{ asset('images/totalkendaraan.png') }}" alt="Total Kendaraan" class="size-12 object-contain drop-shadow-sm">
                    </div>
                    <div class="min-w-0 text-left">
                        <flux:heading size="xl" class="font-bold text-slate-900 dark:text-white">
                            {{ $totalVehicle }}
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 font-medium text-slate-500 dark:text-slate-400">
                            Total Kendaraan
                        </flux:text>
                    </div>
                </div>
            </div>

            {{-- KENDARAAN AKTIF --}}
            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-lg shadow-slate-200/50 border border-slate-100 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl hover:shadow-sky-900/10 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">
                <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl bg-gradient-to-r from-sky-400 to-cyan-500"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="relative flex size-16 shrink-0 items-center justify-center rounded-2xl bg-slate-50 dark:bg-slate-800/50 transition-transform duration-300 group-hover:scale-110 group-hover:-translate-y-0.5">
                        <img src="{{ asset('images/kendaraanaktif.png') }}" alt="Kendaraan Aktif" class="size-12 object-contain drop-shadow-sm">
                    </div>
                    <div class="min-w-0 text-left">
                        <flux:heading size="xl" class="font-bold text-slate-900 dark:text-white">
                            {{ $activeVehicles }}
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 font-medium text-slate-500 dark:text-slate-400">
                            Kendaraan Aktif
                        </flux:text>
                    </div>
                </div>
            </div>

            {{-- PAJAK BELUM BAYAR --}}
            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-lg shadow-slate-200/50 border border-slate-100 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl hover:shadow-sky-900/10 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">
                <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl bg-gradient-to-r from-sky-400 to-cyan-500"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="relative flex size-16 shrink-0 items-center justify-center rounded-2xl bg-slate-50 dark:bg-slate-800/50 transition-transform duration-300 group-hover:scale-110 group-hover:-translate-y-0.5">
                        <img src="{{ asset('images/pajakbelumbayar.png') }}" alt="Pajak Belum Bayar" class="size-12 object-contain drop-shadow-sm">
                    </div>
                    <div class="min-w-0 text-left">
                        <flux:heading size="xl" class="font-bold text-slate-900 dark:text-white">
                            {{ $expiredTax }}
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 font-medium text-slate-500 dark:text-slate-400">
                            Pajak Belum Bayar
                        </flux:text>
                    </div>
                </div>
            </div>

            {{-- STNK BELUM BAYAR --}}
            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-lg shadow-slate-200/50 border border-slate-100 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl hover:shadow-sky-900/10 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">
                <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl bg-gradient-to-r from-sky-400 to-cyan-500"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="relative flex size-16 shrink-0 items-center justify-center rounded-2xl bg-slate-50 dark:bg-slate-800/50 transition-transform duration-300 group-hover:scale-110 group-hover:-translate-y-0.5">
                        <img src="{{ asset('images/stnkbelumbayar.png') }}" alt="STNK Belum Bayar" class="size-12 object-contain drop-shadow-sm">
                    </div>
                    <div class="min-w-0 text-left">
                        <flux:heading size="xl" class="font-bold text-slate-900 dark:text-white">
                            {{ $expiredStnk }}
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 font-medium text-slate-500 dark:text-slate-400">
                            STNK Belum Bayar
                        </flux:text>
                    </div>
                </div>
            </div>

        </div>

        {{-- =========================================================
            REKAP & AKSES CEPAT
        ========================================================== --}}
        <div class="grid gap-6 lg:grid-cols-[1.4fr_1fr] relative z-10">

            {{-- REKAPITULASI KENDARAAN --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">
                <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/80 px-6 py-5 dark:border-slate-800 dark:bg-slate-800/50">
                    <div>
                        <flux:heading size="sm" class="font-bold text-slate-900 dark:text-white">
                            Rekapitulasi Kendaraan
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 text-slate-500 dark:text-slate-400">
                            Komposisi armada operasional saat ini
                        </flux:text>
                    </div>
                    <div class="flex size-10 items-center justify-center rounded-xl bg-cyan-50 dark:bg-cyan-900/40">
                        <flux:icon name="chart-pie" class="size-5 text-cyan-600 dark:text-cyan-400" />
                    </div>
                </div>

                <div class="p-6">
                    {{-- Persentase --}}
                    <div class="mb-3 flex items-center justify-between text-sm">
                        <span class="font-semibold text-slate-700 dark:text-slate-200">
                            Kendaraan Aktif
                        </span>
                        <span class="font-bold text-cyan-600 dark:text-cyan-400 text-lg">
                            {{ $activePercentage }}%
                        </span>
                    </div>

                    {{-- Progress Bar dengan efek Glow --}}
                    <div class="h-3.5 overflow-hidden rounded-full bg-slate-100 border border-slate-200/50 dark:bg-slate-800 dark:border-slate-700">
                        <div
                            class="h-full rounded-full bg-gradient-to-r from-sky-400 to-cyan-500 transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(56,189,248,0.4)]"
                            style="width: {{ $activePercentage }}%"
                        ></div>
                    </div>

                    {{-- Detail Card Mini --}}
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="rounded-xl bg-slate-50 p-4 border border-slate-100 shadow-sm dark:bg-slate-800/40 dark:border-slate-700/50">
                            <div class="flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
                                <div class="size-2 rounded-full bg-cyan-500"></div>
                                Aktif
                            </div>
                            <div class="mt-2 text-2xl font-bold text-slate-800 dark:text-slate-100">
                                {{ $activeVehicles }}
                            </div>
                        </div>

                        <div class="rounded-xl bg-slate-50 p-4 border border-slate-100 shadow-sm dark:bg-slate-800/40 dark:border-slate-700/50">
                            <div class="flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
                                <div class="size-2 rounded-full bg-slate-300 dark:bg-slate-600"></div>
                                Belum Aktif
                            </div>
                            <div class="mt-2 text-2xl font-bold text-slate-800 dark:text-slate-100">
                                {{ max(0, $totalVehicle - $activeVehicles) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- AKSES CEPAT --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20 flex flex-col">
                <div class="border-b border-slate-100 bg-slate-50/80 px-6 py-5 dark:border-slate-800 dark:bg-slate-800/50">
                    <flux:heading size="sm" class="font-bold text-slate-900 dark:text-white">
                        Akses Cepat
                    </flux:heading>
                    <flux:text size="sm" class="mt-0.5 text-slate-500 dark:text-slate-400">
                        Jalan pintas kelola data kendaraan
                    </flux:text>
                </div>

                <div class="flex flex-col gap-3 p-6 flex-1 justify-center">
                    <flux:button
                        :href="route('vehicles.index')"
                        icon="list-bullet"
                        class="w-full justify-center py-3 font-semibold !bg-cyan-600 hover:!bg-cyan-700 !text-white !border-transparent shadow-md dark:!bg-cyan-600 dark:hover:!bg-cyan-500 transition-colors"
                    >
                        Lihat Daftar Kendaraan
                    </flux:button>

                    <flux:button
                        :href="route('vehicles.create')"
                        icon="plus"
                        variant="ghost"
                        class="w-full justify-center py-3 font-semibold text-slate-700 hover:bg-slate-50 border border-slate-200 shadow-sm dark:text-slate-200 dark:hover:bg-slate-800 dark:border-slate-700 transition-colors"
                    >
                        Tambah Kendaraan Baru
                    </flux:button>
                </div>
            </div>

        </div>

    </div>
</x-layouts::app>