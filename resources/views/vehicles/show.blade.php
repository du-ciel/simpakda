<x-layouts::app :title="__('Detail Kendaraan')">
    <div class="mx-auto flex h-full w-full max-w-6xl flex-1 flex-col gap-5 pb-8">
        <div class="flex flex-col gap-4 rounded-3xl bg-gradient-to-br from-cyan-600 via-sky-700 to-indigo-800 px-6 py-6 text-white shadow-lg shadow-sky-900/15 sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <div>
                <div class="mb-1 flex items-center gap-2 text-cyan-100"><flux:icon name="eye" class="size-4" /><span class="text-xs font-semibold uppercase tracking-[0.18em]">Armada</span></div>
                <flux:heading size="lg" class="text-white">Detail Kendaraan</flux:heading>
                <flux:text class="mt-1 text-sky-100">Informasi lengkap kendaraan dan dokumen terkait.</flux:text>
            </div>
            <flux:button.group>
                <flux:button :href="route('vehicles.index')" variant="primary" icon="arrow-left" >
                    Kembali 
                </flux:button>
                <flux:button :href="route('vehicles.edit', $vehicle->id)" variant="primary" icon="pencil" hover-class="bg-sky-700/90" >
                    Edit
                </flux:button>
            </flux:button.group>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60 ring-offset-2 ring-offset-sky-50 dark:ring-offset-dark-900">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Spesifikasi</flux:heading>
                </div>
                <div class="p-4">
                    <dl class="grid grid-cols-2 gap-4 text-sm">
                        <dt class="text-slate-500 dark:text-slate-400">No Polisi</dt>
                        <dd class="font-medium">{{ $vehicle->nomor_polisi }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">Merek</dt>
                        <dd class="font-medium">{{ $vehicle->merek }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">Tipe</dt>
                        <dd class="font-medium">{{ $vehicle->tipe }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">Jenis</dt>
                        <dd class="font-medium">{{ $vehicle->jenis }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">Tahun</dt>
                        <dd class="font-medium">{{ $vehicle->tahun_pemakaian }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">No Chasis</dt>
                        <dd class="font-medium">{{ $vehicle->nomor_chasis }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">No Mesin</dt>
                        <dd class="font-medium">{{ $vehicle->nomor_mesin }}</dd>
                    </dl>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-teal-100 dark:bg-slate-900 dark:ring-teal-900/60">
                <div class="border-b border-teal-100 bg-gradient-to-r from-teal-50 to-cyan-50 px-5 py-4 dark:border-teal-900/50 dark:from-teal-950/30 dark:to-cyan-950/30">
                    <flux:heading size="sm" class="text-teal-900 dark:text-teal-100">Kategori</flux:heading>
                </div>
                <div class="p-4">
                    <dl class="grid grid-cols-2 gap-4 text-sm">
                        <dt class="text-slate-500 dark:text-slate-400">Kategori</dt>
                        <dd class="font-medium">{{ $vehicle->kategori }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">Sub Kategori</dt>
                        <dd class="font-medium">{{ $vehicle->sub_kategori ?? '-' }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">Status</dt>
                        <dd>
                            @if ($vehicle->status === 'aktif')
                                <flux:badge color="teal">{{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}</flux:badge>
                            @elseif ($vehicle->status === 'perbaikan')
                                <flux:badge color="cyan">{{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}</flux:badge>
                            @elseif ($vehicle->status === 'dijual')
                                <flux:badge color="red">{{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}</flux:badge>
                            @else
                                <flux:badge color="zinc">{{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}</flux:badge>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Pemakai</flux:heading>
                </div>
                <div class="p-4">
                    <dl class="grid grid-cols-2 gap-4 text-sm">
                        <dt class="text-slate-500 dark:text-slate-400">Nama</dt>
                        <dd class="font-medium">{{ $vehicle->nama_pemakai }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">Jabatan</dt>
                        <dd class="font-medium">{{ $vehicle->jabatan_pemakai }}</dd>
                    </dl>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-cyan-100 dark:bg-slate-900 dark:ring-cyan-900/60">
                <div class="border-b border-cyan-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-cyan-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-cyan-900 dark:text-cyan-100">Masa Berlaku</flux:heading>
                </div>
                <div class="p-4">
                    <dl class="grid grid-cols-2 gap-4 text-sm">
                        <dt class="text-slate-500 dark:text-slate-400">Pajak</dt>
                        <dd class="font-medium">
                            {{ $vehicle->masa_berlaku_pajak->format('d/m/Y') }}
                            @if ($vehicle->isPajakExpired())
                                <flux:badge color="red" class="ml-2">Belum Bayar</flux:badge>
                            @endif
                        </dd>
                        <dt class="text-slate-500 dark:text-slate-400">STNK</dt>
                        <dd class="font-medium">
                            {{ $vehicle->masa_berlaku_stnk->format('d/m/Y') }}
                            @if ($vehicle->isStnkExpired())
                                <flux:badge color="red" class="ml-2">Belum Bayar</flux:badge>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-indigo-100 dark:bg-slate-900 dark:ring-indigo-900/60">
                <div class="border-b border-indigo-100 bg-gradient-to-r from-sky-50 to-indigo-50 px-5 py-4 dark:border-indigo-900/50 dark:from-sky-950/30 dark:to-indigo-950/30">
                    <flux:heading size="sm" class="text-indigo-900 dark:text-indigo-100">Biaya</flux:heading>
                </div>
                <div class="p-4">
                    <dl class="grid grid-cols-2 gap-4 text-sm">
                        <dt class="text-slate-500 dark:text-slate-400">Anggaran</dt>
                        <dd class="font-medium">Rp {{ number_format($vehicle->anggaran_biaya, 0, ',', '.') }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">Biaya Plat/STNK</dt>
                        <dd class="font-medium">Rp {{ number_format($vehicle->biaya_plat_stnk, 0, ',', '.') }}</dd>
                        <dt class="text-slate-500 dark:text-slate-400">Sumber Kendaraan</dt>
                        <dd class="font-medium">{{ $vehicle->sumber_kendaraan }}</dd>
                    </dl>
                </div>
            </div>

            @if ($vehicle->keterangan_pajak || $vehicle->keterangan_kendaraan)
                <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60 lg:col-span-2">
                    <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                        <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Keterangan</flux:heading>
                    </div>
                    <div class="space-y-4 p-4">
                        @if ($vehicle->keterangan_pajak)
                            <div>
                                <dt class="text-sm text-slate-500 dark:text-slate-400">Keterangan Pajak</dt>
                                <dd>{{ $vehicle->keterangan_pajak }}</dd>
                            </div>
                        @endif
                        @if ($vehicle->keterangan_kendaraan)
                            <div>
                                <dt class="text-sm text-slate-500 dark:text-slate-400">Keterangan Kendaraan</dt>
                                <dd>{{ $vehicle->keterangan_kendaraan }}</dd>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        @include('vehicles._history', ['vehicle' => $vehicle])
    </div>
</x-layouts::app>
