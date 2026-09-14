<x-layouts::app :title="__('Monitoring')">
    
    {{-- =========================================================
        AMBIENT BACKGROUND GLOW (Gradient Latar Belakang)
    ========================================================== --}}
    <div class="fixed inset-0 z-[-1] bg-gradient-to-br from-[#e0f2fe] via-[#f0f9ff] to-[#cffafe] dark:from-[#020617] dark:via-[#0f172a] dark:to-[#083344] pointer-events-none overflow-hidden">
        {{-- Cahaya dari Kiri Atas (Cyan) --}}
        <div class="absolute -top-[20%] -left-[10%] w-[70vw] h-[70vw] max-w-[800px] max-h-[800px] rounded-full bg-[#22d3ee]/20 blur-[120px] dark:bg-cyan-900/30"></div>
        {{-- Cahaya dari Kanan Bawah (Sky) --}}
        <div class="absolute -bottom-[20%] -right-[10%] w-[60vw] h-[60vw] max-w-[600px] max-h-[600px] rounded-full bg-[#38bdf8]/20 blur-[120px] dark:bg-sky-900/30"></div>
    </div>

    <div class="relative mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-6 pb-8 z-0">

        {{-- =========================================================
            HEADER MONITORING
        ========================================================== --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#111827] to-[#0b334d] px-6 py-8 text-white shadow-xl sm:px-10 dark:shadow-cyan-950/20">
            <div class="pointer-events-none absolute -right-12 -top-16 size-48 rounded-full border-[18px] border-white/5"></div>
            
            <div class="relative z-10">
                <div class="mb-2 flex items-center gap-2 text-cyan-400">
                    <flux:icon name="signal" class="size-4" />
                    <span class="text-xs font-bold uppercase tracking-[0.2em]">Pusat Monitoring</span>
                </div>
                <flux:heading size="xl" class="text-white font-bold tracking-tight">Monitoring Kendaraan</flux:heading>
                <flux:text class="mt-2 text-slate-300 max-w-xl text-sm leading-relaxed">
                    Ringkasan kondisi, notifikasi pembayaran, dan masa berlaku dokumen kendaraan Anda.
                </flux:text>
            </div>
        </div>

        {{-- Flash Message Success --}}
        @if (session('success'))
            <div class="flex items-center gap-3 rounded-xl border border-teal-200 bg-white p-4 text-sm font-medium text-teal-800 shadow-md dark:bg-slate-900 dark:border-teal-900/60 dark:text-teal-300">
                <flux:icon name="check-circle" class="size-5 shrink-0 text-teal-500 dark:text-teal-400" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- =========================================================
            ALERT: PAJAK JATUH TEMPO
        ========================================================== --}}
        <div class="relative z-10 overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-none">
            <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 px-6 py-5">
                <div class="flex items-center gap-4">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-cyan-50 dark:bg-cyan-950/60">
                        <flux:icon name="calendar-days" class="size-6 text-cyan-600 dark:text-cyan-400" />
                    </div>
                    <div>
                        <flux:heading size="sm" class="font-bold text-slate-900 dark:text-white">
                            Pajak Jatuh Tempo {{ $reminderYear }}
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 text-slate-500 dark:text-slate-400">
                            Kendaraan yang memerlukan pembayaran pajak tahun ini
                        </flux:text>
                    </div>
                </div>
                <div class="hidden sm:block">
                    <flux:badge color="amber" class="font-bold px-3 py-1 text-sm">{{ $reminderCount }} Kendaraan</flux:badge>
                </div>
            </div>

            <div class="max-h-[450px] overflow-y-auto px-6">
                @forelse ($vehiclesDueThisYear as $v)
                    <div class="flex flex-col gap-4 border-b border-slate-100 dark:border-slate-800/80 py-5 last:border-0 sm:flex-row sm:items-center sm:justify-between">
                        <div class="min-w-0 flex flex-col gap-1">
                            <div class="flex items-center gap-3">
                                <span class="font-bold text-slate-900 dark:text-white text-lg">{{ $v->nomor_polisi }}</span>
                                <flux:badge color="amber" size="sm" class="sm:hidden">Perlu Dibayar</flux:badge>
                            </div>
                            <div class="truncate text-sm font-medium text-slate-600 dark:text-slate-300">
                                {{ $v->merek }} {{ $v->tipe }} <span class="mx-1 text-slate-300 dark:text-slate-600">&bull;</span> {{ $v->nama_pemakai }}
                            </div>
                            <div class="text-xs font-semibold text-amber-600 dark:text-amber-400 mt-1 flex items-center gap-1.5">
                                <flux:icon name="clock" class="size-3.5" />
                                Jatuh tempo: {{ $v->masa_berlaku_pajak->format('d/m/Y') }}
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('vehicles.tax-paid', $v) }}" class="flex shrink-0 items-center gap-3 sm:justify-end mt-2 sm:mt-0" onsubmit="return confirm('Tandai pajak sudah dibayar?')">
                            @csrf
                            <flux:badge color="amber" class="hidden sm:inline-flex">Perlu Dibayar</flux:badge>
                            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-cyan-700 transition-all dark:bg-cyan-500 dark:hover:bg-cyan-600">
                                <flux:icon name="check-circle" class="size-4" />
                                Sudah Dibayar
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="py-12 text-center flex flex-col items-center justify-center">
                        <flux:icon name="check-circle" class="size-8 text-teal-500 dark:text-teal-400 mb-4" />
                        <flux:heading size="md" class="text-slate-900 dark:text-white">Semua Pajak Aman!</flux:heading>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- DETAIL SPLIT --}}
        <div class="grid items-start gap-6 lg:grid-cols-2">
            
            {{-- Kartu: Pajak Akan Jatuh Tempo --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-black/5 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-none flex flex-col h-full">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 px-6 py-5">
                    <div>
                        <flux:heading size="sm" class="font-bold text-slate-900 dark:text-white">Pajak Akan Jatuh Tempo</flux:heading>
                        <flux:text size="sm" class="mt-0.5 text-slate-500 dark:text-slate-400">Peringatan dalam 3 minggu kedepan</flux:text>
                    </div>
                    <flux:icon name="clock" class="size-5 text-cyan-600 dark:text-cyan-400" />
                </div>
                <div class="px-6 py-2 flex-1">
                    @forelse ($expiringSoon as $v)
                        <div class="flex items-center justify-between py-4 border-b last:border-0 border-slate-100 dark:border-slate-800">
                            <div>
                                <div class="font-bold text-slate-900 dark:text-white">{{ $v->nomor_polisi }}</div>
                                <div class="text-sm text-slate-500 dark:text-slate-400">{{ $v->merek }} {{ $v->tipe }}</div>
                            </div>
                            <flux:badge color="cyan">{{ diff_for_humans_id($v->masa_berlaku_pajak) }}</flux:badge>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-500 dark:text-slate-400 text-sm">Tidak ada pajak yang mendesak.</div>
                    @endforelse
                </div>
            </div>

            {{-- Kartu: Kendaraan Non Aktif --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-black/5 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-none flex flex-col h-full">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 px-6 py-5">
                    <div>
                        <flux:heading size="sm" class="font-bold text-slate-900 dark:text-white">Kendaraan Non Aktif</flux:heading>
                        <flux:text size="sm" class="mt-0.5 text-slate-500 dark:text-slate-400">Status perbaikan atau tidak digunakan</flux:text>
                    </div>
                    <flux:icon name="wrench-screwdriver" class="size-5 text-cyan-600 dark:text-cyan-400" />
                </div>
                <div class="px-6 py-2 flex-1">
                    @forelse ($inactive as $v)
                        <div class="flex items-center justify-between py-4 border-b last:border-0 border-slate-100 dark:border-slate-800">
                            <div>
                                <div class="font-bold text-slate-900 dark:text-white">{{ $v->nomor_polisi }}</div>
                                <div class="text-sm text-slate-500 dark:text-slate-400">{{ $v->merek }} {{ $v->tipe }}</div>
                            </div>
                            <flux:badge :color="$v->status === 'perbaikan' ? 'yellow' : 'zinc'">{{ ucfirst($v->status) }}</flux:badge>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-500 dark:text-slate-400 text-sm">Semua armada dalam kondisi aktif.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>