<div>
    <div class="mb-6 flex items-center justify-between">
        <flux:heading size="lg">Detail Kendaraan</flux:heading>
        <flux:button.group>
            <flux:button :href="route('vehicles.edit', $vehicle->id)" wire:navigate variant="primary" icon="pencil">
                Edit
            </flux:button>
            <flux:button :href="route('vehicles.index')" wire:navigate variant="ghost" icon="arrow-left">
                Kembali
            </flux:button>
        </flux:button.group>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Spesifikasi</flux:heading>
            </div>
            <div class="p-4">
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <dt class="text-zinc-500">No Polisi</dt>
                    <dd class="font-medium">{{ $vehicle->nomor_polisi }}</dd>
                    <dt class="text-zinc-500">Merek</dt>
                    <dd class="font-medium">{{ $vehicle->merek }}</dd>
                    <dt class="text-zinc-500">Tipe</dt>
                    <dd class="font-medium">{{ $vehicle->tipe }}</dd>
                    <dt class="text-zinc-500">Jenis</dt>
                    <dd class="font-medium">{{ $vehicle->jenis }}</dd>
                    <dt class="text-zinc-500">Tahun</dt>
                    <dd class="font-medium">{{ $vehicle->tahun_pemakaian }}</dd>
                    <dt class="text-zinc-500">No Chasis</dt>
                    <dd class="font-medium">{{ $vehicle->nomor_chasis }}</dd>
                    <dt class="text-zinc-500">No Mesin</dt>
                    <dd class="font-medium">{{ $vehicle->nomor_mesin }}</dd>
                </dl>
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Kategori</flux:heading>
            </div>
            <div class="p-4">
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <dt class="text-zinc-500">Kategori</dt>
                    <dd class="font-medium">{{ $vehicle->kategori }}</dd>
                    <dt class="text-zinc-500">Sub Kategori</dt>
                    <dd class="font-medium">{{ $vehicle->sub_kategori ?? '-' }}</dd>
                    <dt class="text-zinc-500">Status</dt>
                    <dd>
                        <flux:badge
                            :color="$vehicle->status === 'aktif' ? 'green' : ($vehicle->status === 'non_aktif' ? 'zinc' : ($vehicle->status === 'perbaikan' ? 'yellow' : 'red'))"
                        >
                            {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                        </flux:badge>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Pemakai</flux:heading>
            </div>
            <div class="p-4">
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <dt class="text-zinc-500">Nama</dt>
                    <dd class="font-medium">{{ $vehicle->nama_pemakai }}</dd>
                    <dt class="text-zinc-500">Jabatan</dt>
                    <dd class="font-medium">{{ $vehicle->jabatan_pemakai }}</dd>
                </dl>
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Masa Berlaku</flux:heading>
            </div>
            <div class="p-4">
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <dt class="text-zinc-500">Pajak</dt>
                    <dd class="font-medium">
                        {{ $vehicle->masa_berlaku_pajak->format('d/m/Y') }}
                        @if ($vehicle->isPajakExpired())
                            <flux:badge color="red" class="ml-2">Expired</flux:badge>
                        @endif
                    </dd>
                    <dt class="text-zinc-500">STNK</dt>
                    <dd class="font-medium">
                        {{ $vehicle->masa_berlaku_stnk->format('d/m/Y') }}
                        @if ($vehicle->isStnkExpired())
                            <flux:badge color="red" class="ml-2">Expired</flux:badge>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Biaya</flux:heading>
            </div>
            <div class="p-4">
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <dt class="text-zinc-500">Anggaran</dt>
                    <dd class="font-medium">Rp {{ number_format($vehicle->anggaran_biaya, 0, ',', '.') }}</dd>
                    <dt class="text-zinc-500">Biaya Plat/STNK</dt>
                    <dd class="font-medium">Rp {{ number_format($vehicle->biaya_plat_stnk, 0, ',', '.') }}</dd>
                    <dt class="text-zinc-500">Sumber Dana</dt>
                    <dd class="font-medium">{{ $vehicle->sumber_dana }}</dd>
                </dl>
            </div>
        </div>

        @if ($vehicle->keterangan_pajak || $vehicle->keterangan_kendaraan)
            <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800 lg:col-span-2">
                <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                    <flux:heading size="sm">Keterangan</flux:heading>
                </div>
                <div class="space-y-4 p-4">
                    @if ($vehicle->keterangan_pajak)
                        <div>
                            <dt class="text-sm text-zinc-500">Keterangan Pajak</dt>
                            <dd>{{ $vehicle->keterangan_pajak }}</dd>
                        </div>
                    @endif
                    @if ($vehicle->keterangan_kendaraan)
                        <div>
                            <dt class="text-sm text-zinc-500">Keterangan Kendaraan</dt>
                            <dd>{{ $vehicle->keterangan_kendaraan }}</dd>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    @include('vehicles._history', ['vehicle' => $vehicle])
</div>
