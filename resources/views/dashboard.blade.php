<x-layouts::app :title="__('Dashboard')">
    <div class="mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-6 pb-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-cyan-600 via-sky-700 to-indigo-800 px-6 py-7 text-white shadow-lg shadow-sky-900/15 sm:px-8">
            <div class="pointer-events-none absolute -right-12 -top-16 size-48 rounded-full border-[18px] border-white/10"></div>
            <div class="pointer-events-none absolute -bottom-24 right-24 size-56 rounded-full border-[22px] border-white/10"></div>
            <div class="relative">
                <div class="mb-2 flex items-center gap-2 text-cyan-100">
                    <flux:icon name="home" class="size-4" />
                    <span class="text-xs font-semibold uppercase tracking-[0.2em]">Ringkasan Sistem</span>
                </div>
                <flux:heading size="lg" class="text-white">Dashboard</flux:heading>
                <flux:text class="mt-1 text-sky-100">Pantau kondisi armada dan dokumen kendaraan dengan cepat.</flux:text>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-sky-100 transition hover:-translate-y-0.5 hover:shadow-md dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-cyan-400 to-sky-600"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-sky-100 text-sky-700 transition group-hover:bg-sky-600 group-hover:text-white dark:bg-sky-900/60 dark:text-sky-300 dark:group-hover:bg-sky-500">
                        <flux:icon name="truck" class="size-5" />
                    </div>
                    <div>
                        <flux:heading size="lg" class="text-slate-900 dark:text-white">{{ $totalVehicle }}</flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-slate-400">Total Kendaraan</flux:text>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-teal-100 transition hover:-translate-y-0.5 hover:shadow-md dark:bg-slate-900 dark:ring-teal-900/60">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-teal-400 to-cyan-600"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-teal-100 text-teal-700 transition group-hover:bg-teal-600 group-hover:text-white dark:bg-teal-900/60 dark:text-teal-300 dark:group-hover:bg-teal-500">
                        <flux:icon name="check-circle" class="size-5" />
                    </div>
                    <div>
                        <flux:heading size="lg" class="text-slate-900 dark:text-white">{{ $activeVehicles }}</flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-slate-400">Kendaraan Aktif</flux:text>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-cyan-100 transition hover:-translate-y-0.5 hover:shadow-md dark:bg-slate-900 dark:ring-cyan-900/60">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-cyan-400 to-blue-600"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700 transition group-hover:bg-cyan-600 group-hover:text-white dark:bg-cyan-900/60 dark:text-cyan-300 dark:group-hover:bg-cyan-500">
                        <flux:icon name="currency-dollar" class="size-5" />
                    </div>
                    <div>
                        <flux:heading size="lg" class="text-slate-900 dark:text-white">{{ $expiredTax }}</flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-slate-400">Pajak Belum Bayar</flux:text>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-indigo-100 transition hover:-translate-y-0.5 hover:shadow-md dark:bg-slate-900 dark:ring-indigo-900/60">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-sky-500 to-indigo-600"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700 transition group-hover:bg-indigo-600 group-hover:text-white dark:bg-indigo-900/60 dark:text-indigo-300 dark:group-hover:bg-indigo-500">
                        <flux:icon name="document-text" class="size-5" />
                    </div>
                    <div>
                        <flux:heading size="lg" class="text-slate-900 dark:text-white">{{ $expiredStnk }}</flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-slate-400">STNK Belum Bayar</flux:text>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-5 lg:grid-cols-[1.4fr_1fr]">
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-cyan-100 dark:bg-slate-900 dark:ring-cyan-900/60">
                <div class="flex items-center justify-between border-b border-cyan-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-cyan-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <div>
                        <flux:heading size="sm" class="text-slate-900 dark:text-white">Rekapitulasi Kendaraan</flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-slate-400">Komposisi armada saat ini</flux:text>
                    </div>
                    <div class="rounded-xl bg-cyan-100 p-2.5 dark:bg-cyan-900/60">
                        <flux:icon name="chart-bar" class="size-5 text-cyan-700 dark:text-cyan-300" />
                    </div>
                </div>
                <div class="p-5">
                    <div class="mb-2 flex items-center justify-between text-sm">
                        <span class="font-medium text-slate-700 dark:text-slate-200">Kendaraan aktif</span>
                        <span class="font-semibold text-cyan-700 dark:text-cyan-300">{{ $activePercentage }}%</span>
                    </div>
                    <div class="h-3 overflow-hidden rounded-full bg-sky-100 dark:bg-sky-950">
                        <div class="h-full rounded-full bg-gradient-to-r from-cyan-500 to-sky-600 transition-all" style="width: {{ $activePercentage }}%"></div>
                    </div>
                    <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
                        <div class="rounded-xl bg-sky-50 p-3 dark:bg-sky-950/40">
                            <div class="text-slate-500 dark:text-slate-400">Aktif</div>
                            <div class="mt-1 text-lg font-semibold text-sky-800 dark:text-sky-200">{{ $activeVehicles }}</div>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-3 dark:bg-slate-800">
                            <div class="text-slate-500 dark:text-slate-400">Belum aktif</div>
                            <div class="mt-1 text-lg font-semibold text-slate-800 dark:text-slate-100">{{ max(0, $totalVehicle - $activeVehicles) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-teal-100 dark:bg-slate-900 dark:ring-teal-900/60">
                <div class="border-b border-teal-100 bg-gradient-to-r from-teal-50 to-cyan-50 px-5 py-4 dark:border-teal-900/50 dark:from-teal-950/30 dark:to-cyan-950/30">
                    <flux:heading size="sm" class="text-slate-900 dark:text-white">Akses Cepat</flux:heading>
                    <flux:text size="sm" class="text-slate-500 dark:text-slate-400">Kelola data kendaraan</flux:text>
                </div>
                <div class="grid gap-3 p-5 sm:grid-cols-2 lg:grid-cols-1">
                    <flux:button :href="route('vehicles.index')" icon="truck" variant="primary" class="w-full justify-center">Lihat Kendaraan</flux:button>
                    <flux:button :href="route('vehicles.create')" icon="plus" variant="ghost" class="w-full justify-center text-cyan-700 dark:text-cyan-300">Tambah Kendaraan</flux:button>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
