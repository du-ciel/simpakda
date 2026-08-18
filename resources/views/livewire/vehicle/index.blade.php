<div>
    <div class="mb-4 flex items-center justify-between">
        <flux:heading size="lg">Data Kendaraan</flux:heading>
        <flux:button :href="route('vehicles.create')" icon="plus" wire:navigate>
            Tambah Kendaraan
        </flux:button>
    </div>

    @if (session()->has('message'))
        <flux:badge color="green" class="mb-4">{{ session('message') }}</flux:badge>
    @endif

    <div class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-3">
        <flux:input wire:model.live.debounce.300ms="search" placeholder="Cari nomor polisi, merek, pemakai..." icon="magnifying-glass" />

        <flux:select wire:model.live="filterKategori">
            <flux:select.option value="">Semua Kategori</flux:select.option>
            @foreach ($kategoriList as $kategori)
                <flux:select.option value="{{ $kategori }}">{{ $kategori }}</flux:select.option>
            @endforeach
        </flux:select>

        <flux:select wire:model.live="filterStatus">
            <flux:select.option value="">Semua Status</flux:select.option>
            <flux:select.option value="aktif">Aktif</flux:select.option>
            <flux:select.option value="non_aktif">Non Aktif</flux:select.option>
            <flux:select.option value="perbaikan">Perbaikan</flux:select.option>
            <flux:select.option value="dijual">Dijual</flux:select.option>
        </flux:select>
    </div>

    <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full">
            <thead class="bg-zinc-50 dark:bg-zinc-800">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium">No</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">No Polisi</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Merek / Tipe</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Kategori</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Pemakai</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Pajak</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">STNK</th>
                    <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                    <th class="px-4 py-3 text-center text-sm font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100 dark:divide-neutral-700">
                @forelse ($vehicles as $index => $vehicle)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                        <td class="px-4 py-3 text-sm">{{ $vehicles->firstItem() + $index }}</td>
                        <td class="px-4 py-3 text-sm font-medium">{{ $vehicle->nomor_polisi }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div>{{ $vehicle->merek }}</div>
                            <div class="text-xs text-zinc-500">{{ $vehicle->tipe }} / {{ $vehicle->jenis }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div>{{ $vehicle->kategori }}</div>
                            @if ($vehicle->sub_kategori)
                                <div class="text-xs text-zinc-500">{{ $vehicle->sub_kategori }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div>{{ $vehicle->nama_pemakai }}</div>
                            <div class="text-xs text-zinc-500">{{ $vehicle->jabatan_pemakai }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if ($vehicle->isPajakExpired())
                                <flux:badge color="red">Belum Bayar</flux:badge>
                            @elseif ($vehicle->isPajakExpiringSoon())
                                <flux:badge color="yellow">{{ $vehicle->masa_berlaku_pajak->format('d/m/Y') }}</flux:badge>
                            @else
                                <span class="text-xs">{{ $vehicle->masa_berlaku_pajak->format('d/m/Y') }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if ($vehicle->isStnkExpired())
                                <flux:badge color="red">Belum Bayar</flux:badge>
                            @else
                                <span class="text-xs">{{ $vehicle->masa_berlaku_stnk->format('d/m/Y') }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <flux:badge
                                :color="$vehicle->status === 'aktif' ? 'green' : ($vehicle->status === 'non_aktif' ? 'zinc' : ($vehicle->status === 'perbaikan' ? 'yellow' : 'red'))"
                            >
                                {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                            </flux:badge>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <flux:dropdown align="end">
                                <flux:button icon="ellipsis-horizontal" size="sm" square variant="ghost" />

                                <flux:menu>
                                    <flux:menu.item icon="eye" :href="route('vehicles.show', $vehicle->id)" wire:navigate>
                                        Detail
                                    </flux:menu.item>
                                    <flux:menu.item icon="pencil" :href="route('vehicles.edit', $vehicle->id)" wire:navigate>
                                        Edit
                                    </flux:menu.item>
                                    <flux:menu.separator />
                                    <flux:menu.item icon="trash" wire:click="delete({{ $vehicle->id }})" class="text-red-600">
                                        Hapus
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-8 text-center text-zinc-500">
                            Tidak ada data kendaraan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $vehicles->links() }}
    </div>
</div>
