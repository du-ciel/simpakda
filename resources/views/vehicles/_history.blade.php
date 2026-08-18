@php
    $historyLabels = [
        'merek' => 'Merek',
        'tipe' => 'Tipe',
        'jenis' => 'Jenis',
        'nomor_polisi' => 'Nomor Polisi',
        'nomor_chasis' => 'Nomor Chasis',
        'nomor_mesin' => 'Nomor Mesin',
        'tahun_pemakaian' => 'Tahun Pemakaian',
        'masa_berlaku_pajak' => 'Masa Berlaku Pajak',
        'pajak_dibayar_at' => 'Status Pembayaran Pajak',
        'masa_berlaku_stnk' => 'Masa Berlaku STNK',
        'nama_pemakai' => 'Nama Pemakai',
        'jabatan_pemakai' => 'Jabatan Pemakai',
        'keterangan_pajak' => 'Keterangan Pajak',
        'keterangan_kendaraan' => 'Keterangan Kendaraan',
        'anggaran_biaya' => 'Anggaran Biaya',
        'biaya_plat_stnk' => 'Biaya Plat/STNK',
        'sumber_kendaraan' => 'Sumber Kendaraan',
        'kategori' => 'Kategori',
        'sub_kategori' => 'Sub Kategori',
        'status' => 'Status',
    ];
@endphp

<div class="mt-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-cyan-100 dark:bg-slate-900 dark:ring-cyan-900/60">
    <div class="flex items-center justify-between border-b border-cyan-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-cyan-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
        <div>
            <flux:heading size="sm" class="text-cyan-900 dark:text-cyan-100">Riwayat Perubahan</flux:heading>
            <flux:text size="sm" class="text-slate-500 dark:text-slate-400">Catatan perubahan data kendaraan</flux:text>
        </div>
        <div class="rounded-xl bg-cyan-100 p-2.5 dark:bg-cyan-900/60">
            <flux:icon name="clock" class="size-5 text-cyan-700 dark:text-cyan-300" />
        </div>
    </div>

    <div class="divide-y divide-slate-100 dark:divide-slate-800">
        @forelse ($vehicle->histories as $history)
            <div class="px-5 py-4">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 flex size-8 shrink-0 items-center justify-center rounded-full {{ $history->action === 'created' ? 'bg-teal-100 text-teal-700 dark:bg-teal-900/60 dark:text-teal-300' : 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/60 dark:text-cyan-300' }}">
                        <flux:icon name="{{ $history->action === 'created' ? 'plus' : 'pencil' }}" class="size-4" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="font-semibold text-slate-800 dark:text-slate-100">
                            {{ $history->action === 'created' ? 'Kendaraan didaftarkan' : 'Data kendaraan diperbarui' }}
                        </div>
                        <div class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                            {{ $history->created_at?->format('d/m/Y H:i') ?? '-' }}
                            · oleh {{ $history->user?->name ?? 'Sistem' }}
                        </div>
                    </div>
                </div>

                @if ($history->action === 'updated' && is_array($history->changes))
                    <div class="mt-3 grid gap-2 sm:grid-cols-2">
                        @foreach ($history->changes as $field => $change)
                            @php
                                $oldValue = is_array($change) ? ($change['old'] ?? null) : null;
                                $newValue = is_array($change) ? ($change['new'] ?? null) : $change;
                            @endphp
                            <div class="rounded-xl bg-slate-50 px-3 py-2.5 text-sm dark:bg-slate-800/70">
                                <div class="mb-1 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                    {{ $historyLabels[$field] ?? ucfirst(str_replace('_', ' ', $field)) }}
                                </div>
                                <div class="flex min-w-0 items-center gap-2 text-slate-700 dark:text-slate-200">
                                    <span class="min-w-0 flex-1 truncate" title="{{ $oldValue ?? 'Tidak ada' }}">{{ $oldValue ?? 'Tidak ada' }}</span>
                                    <flux:icon name="arrow-right" class="size-3.5 shrink-0 text-cyan-600" />
                                    <span class="min-w-0 flex-1 truncate font-medium" title="{{ $newValue ?? 'Tidak ada' }}">{{ $newValue ?? 'Tidak ada' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="px-5 py-8 text-center text-sm text-slate-500 dark:text-slate-400">
                Belum ada riwayat perubahan.
            </div>
        @endforelse
    </div>
</div>
