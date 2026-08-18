<x-layouts::app :title="__('Monitoring')">
    <div class="mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-6 pb-8">

        {{-- Header --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-cyan-600 via-sky-700 to-indigo-800 px-6 py-7 text-white shadow-lg shadow-sky-900/15 sm:px-8">
            <div class="pointer-events-none absolute -right-12 -top-16 size-48 rounded-full border-[18px] border-white/10"></div>
            <div class="pointer-events-none absolute -bottom-24 right-24 size-56 rounded-full border-[22px] border-white/10"></div>
            <div class="relative">
                <div class="mb-2 flex items-center gap-2 text-cyan-100">
                    <flux:icon name="signal" class="size-4" />
                    <span class="text-xs font-semibold uppercase tracking-[0.2em]">Pusat Monitoring</span>
                </div>
                <flux:heading size="lg" class="text-white">Monitoring Kendaraan</flux:heading>
                <flux:text class="mt-1 text-sky-100">
                    Ringkasan kondisi dan masa berlaku dokumen kendaraan Anda.
                </flux:text>
            </div>
        </div>

        @if (session('success'))
            <div class="flex items-center gap-3 rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm font-medium text-teal-800 dark:border-teal-900/60 dark:bg-teal-950/40 dark:text-teal-200">
                <flux:icon name="check-circle" class="size-5 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border border-amber-200 bg-gradient-to-r from-amber-50 to-orange-50 shadow-sm dark:border-amber-900/50 dark:from-amber-950/40 dark:to-orange-950/40">
            <div class="flex items-center justify-between border-b border-amber-200 px-5 py-4 dark:border-amber-900/50">
                <div class="flex items-center gap-3">
                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 dark:bg-amber-900/60">
                        <flux:icon name="calendar" class="size-5 text-amber-600 dark:text-amber-300" />
                    </div>
                    <div>
                        <flux:heading size="sm" class="text-amber-900 dark:text-amber-100">
                            Pajak Jatuh Tempo {{ $reminderYear }}
                        </flux:heading>
                        <flux:text size="sm" class="text-amber-700 dark:text-amber-300">
                            {{ $reminderCount }} kendaraan perlu pembayaran pajak tahun ini
                        </flux:text>
                    </div>
                </div>
                <flux:badge color="amber">{{ $reminderCount }}</flux:badge>
            </div>

            <div class="max-h-96 overflow-y-auto px-5">
                @forelse ($vehiclesDueThisYear as $v)
                    <div class="flex flex-col gap-3 border-b border-amber-100 py-4 last:border-0 sm:flex-row sm:items-center sm:justify-between dark:border-amber-900/30">
                        <div class="min-w-0">
                            <div class="font-semibold text-amber-900 dark:text-amber-100">
                                {{ $v->nomor_polisi }}
                            </div>
                            <div class="truncate text-sm text-amber-700 dark:text-amber-300">
                                {{ $v->merek }} {{ $v->tipe }} &bull; {{ $v->nama_pemakai }}
                            </div>
                            <div class="mt-1 text-xs text-amber-600 dark:text-amber-400">
                                Jatuh tempo {{ $v->masa_berlaku_pajak->format('d/m/Y') }}
                            </div>
                        </div>
                        <form method="POST" action="{{ route('vehicles.tax-paid', $v) }}" class="flex shrink-0 items-center gap-2 sm:justify-end" onsubmit="return confirm('Tandai pajak sudah dibayar? Tanggal jatuh tempo pajak akan maju satu tahun. Tanggal STNK tidak akan berubah.')">
                            @csrf
                            <flux:badge color="amber">Perlu Dibayar</flux:badge>
                            <flux:button type="submit" size="sm" icon="check" variant="primary" class="whitespace-nowrap bg-teal-600 text-white hover:bg-teal-700">
                                Sudah Dibayar
                            </flux:button>
                        </form>
                    </div>
                @empty
                    <div class="py-8 text-center">
                        <flux:icon name="check-circle" class="mx-auto size-8 text-teal-500" />
                        <flux:text class="mt-2 text-amber-700 dark:text-amber-300">
                            Tidak ada kendaraan yang jatuh tempo pajak pada tahun {{ $reminderYear }}.
                        </flux:text>
                        <flux:text size="sm" class="mt-1 text-amber-600 dark:text-amber-400">
                            Pembayaran pajak memajukan pengingat satu tahun; tanggal STNK tetap sesuai data admin.
                        </flux:text>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Statistik --}}
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-sky-100 transition duration-200 hover:-translate-y-0.5 hover:shadow-md dark:bg-zinc-900 dark:ring-sky-900/60">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-cyan-400 to-sky-600"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-sky-100 text-sky-700 transition group-hover:bg-sky-600 group-hover:text-white dark:bg-sky-900/60 dark:text-sky-300 dark:group-hover:bg-sky-500">
                        <flux:icon name="truck" class="size-5" />
                    </div>

                    <div>
                        <flux:heading size="lg" class="text-slate-900 dark:text-white">
                            {{ $totalVehicle }}
                        </flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-zinc-400">
                            Total Kendaraan
                        </flux:text>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-teal-100 transition duration-200 hover:-translate-y-0.5 hover:shadow-md dark:bg-zinc-900 dark:ring-teal-900/60">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-teal-400 to-cyan-600"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-teal-100 text-teal-700 transition group-hover:bg-teal-600 group-hover:text-white dark:bg-teal-900/60 dark:text-teal-300 dark:group-hover:bg-teal-500">
                        <flux:icon name="check-circle" class="size-5" />
                    </div>

                    <div>
                        <flux:heading size="lg" class="text-slate-900 dark:text-white">
                            {{ $activeVehicles }}
                        </flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-zinc-400">
                            Kendaraan Aktif
                        </flux:text>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-cyan-100 transition duration-200 hover:-translate-y-0.5 hover:shadow-md dark:bg-zinc-900 dark:ring-cyan-900/60">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-cyan-400 to-blue-600"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700 transition group-hover:bg-cyan-600 group-hover:text-white dark:bg-cyan-900/60 dark:text-cyan-300 dark:group-hover:bg-cyan-500">
                        <flux:icon name="currency-dollar" class="size-5" />
                    </div>

                    <div>
                        <flux:heading size="lg" class="text-slate-900 dark:text-white">
                            {{ $expiredTax }}
                        </flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-zinc-400">
                            Pajak Belum Bayar
                        </flux:text>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-indigo-100 transition duration-200 hover:-translate-y-0.5 hover:shadow-md dark:bg-zinc-900 dark:ring-indigo-900/60">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-sky-500 to-indigo-600"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700 transition group-hover:bg-indigo-600 group-hover:text-white dark:bg-indigo-900/60 dark:text-indigo-300 dark:group-hover:bg-indigo-500">
                        <flux:icon name="document-text" class="size-5" />
                    </div>

                    <div>
                        <flux:heading size="lg" class="text-slate-900 dark:text-white">
                            {{ $expiredStnk }}
                        </flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-zinc-400">
                            STNK Belum Bayar
                        </flux:text>
                    </div>
                </div>
            </div>

        </div>

        {{-- Detail --}}
        <div class="grid items-start gap-5 lg:grid-cols-2">

            {{-- Pajak Akan Jatuh Tempo --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-cyan-100 dark:bg-zinc-900 dark:ring-cyan-900/60">

                <div class="flex items-center justify-between border-b border-cyan-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-cyan-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <div>
                        <flux:heading size="sm" class="text-slate-900 dark:text-white">
                            Pajak Akan Jatuh Tempo
                        </flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-zinc-400">
                            Dalam 3 minggu
                        </flux:text>
                    </div>

                    <div class="rounded-xl bg-cyan-100 p-2.5 dark:bg-cyan-900/60">
                        <flux:icon name="clock" class="size-5 text-cyan-700 dark:text-cyan-300" />
                    </div>
                </div>

                <div class="px-5">
                    @if ($totalVehicle > 0)

                        @forelse ($expiringSoon as $v)

                            <div class="flex items-center justify-between gap-4 border-b border-zinc-100 py-4 last:border-0 dark:border-zinc-800">

                                <div class="min-w-0">
                                    <div class="font-semibold text-slate-800 dark:text-zinc-100">
                                        {{ $v->nomor_polisi }}
                                    </div>

                                    <div class="truncate text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ $v->merek }} {{ $v->tipe }}
                                    </div>
                                </div>

                                <flux:badge color="cyan">
                                    {{ diff_for_humans_id($v->masa_berlaku_pajak) }}
                                </flux:badge>

                            </div>

                        @empty

                            <div class="py-6 text-center">
                                <flux:text class="text-slate-500 dark:text-zinc-400">
                                    Tidak ada kendaraan yang akan jatuh tempo
                                </flux:text>
                            </div>

                        @endforelse

                    @else

                        <div class="py-6 text-center">
                            <flux:text class="text-slate-500 dark:text-zinc-400">
                                Tidak ada data kendaraan
                            </flux:text>
                        </div>

                    @endif
                </div>
            </div>

            {{-- Kendaraan Non Aktif --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-teal-100 dark:bg-zinc-900 dark:ring-teal-900/60">

                <div class="flex items-center justify-between border-b border-teal-100 bg-gradient-to-r from-teal-50 to-cyan-50 px-5 py-4 dark:border-teal-900/50 dark:from-teal-950/30 dark:to-cyan-950/30">
                    <div>
                        <flux:heading size="sm" class="text-slate-900 dark:text-white">
                            Kendaraan Non Aktif
                        </flux:heading>
                        <flux:text size="sm" class="text-slate-500 dark:text-zinc-400">
                            Perbaikan atau tidak digunakan
                        </flux:text>
                    </div>

                    <div class="rounded-xl bg-teal-100 p-2.5 dark:bg-teal-900/60">
                        <flux:icon name="wrench-screwdriver" class="size-5 text-teal-700 dark:text-teal-300" />
                    </div>
                </div>

                <div class="px-5">

                    @if ($totalVehicle > 0)

                        @forelse ($inactive as $v)

                            <div class="flex items-center justify-between gap-4 border-b border-zinc-100 py-4 last:border-0 dark:border-zinc-800">

                                <div class="min-w-0">
                                    <div class="font-semibold text-slate-800 dark:text-zinc-100">
                                        {{ $v->nomor_polisi }}
                                    </div>

                                    <div class="truncate text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ $v->merek }} {{ $v->tipe }}
                                    </div>
                                </div>

                                <flux:badge color="teal">
                                    {{ ucfirst($v->status) }}
                                </flux:badge>

                            </div>

                        @empty

                            <div class="py-6 text-center">
                                <flux:text class="text-slate-500 dark:text-zinc-400">
                                    Semua kendaraan aktif
                                </flux:text>
                            </div>

                        @endforelse

                    @else

                        <div class="py-6 text-center">
                            <flux:text class="text-slate-500 dark:text-zinc-400">
                                Tidak ada data kendaraan
                            </flux:text>
                        </div>

                    @endif

                </div>
            </div>

        </div>
    </div>
</x-layouts::app>
