<x-layouts::app :title="__('Data Kendaraan')">
    <div class="mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-5 pb-8">
        <div class="flex flex-col gap-4 rounded-3xl bg-gradient-to-br from-cyan-600 via-sky-700 to-indigo-800 px-6 py-6 text-white shadow-lg shadow-sky-900/15 sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <div>
                <div class="mb-1 flex items-center gap-2 text-cyan-100">
                    <flux:icon name="truck" class="size-4" />
                    <span class="text-xs font-semibold uppercase tracking-[0.18em]">Armada</span>
                </div>
                <flux:heading size="lg" class="text-white">Data Kendaraan</flux:heading>
                <flux:text class="mt-1 text-sky-100">Kelola seluruh informasi kendaraan dalam satu tempat.</flux:text>
            </div>
            <flux:button :href="route('vehicles.create')" icon="plus" class="border-white/20 bg-white text-sky-800 hover:bg-cyan-50">Tambah Kendaraan</flux:button>

            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-amber-100">Export:</span>
                <flux:button :href="route('vehicles.export', array_merge(request()->query(), ['format' => 'xlsx']))" icon="document-arrow-down" class="border-amber-200 bg-amber-50 text-amber-700 hover:bg-amber-100 dark:border-amber-800 dark:bg-amber-950 dark:text-amber-300 dark:hover:bg-amber-900/50">Excel</flux:button>
                <flux:button :href="route('vehicles.export', array_merge(request()->query(), ['format' => 'csv']))" icon="document-arrow-down" class="border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 dark:hover:bg-emerald-900/50">CSV</flux:button>
                <flux:button :href="route('vehicles.export', array_merge(request()->query(), ['format' => 'pdf']))" icon="document-arrow-down" class="border-rose-200 bg-rose-50 text-rose-700 hover:bg-rose-100 dark:border-rose-800 dark:bg-rose-950 dark:text-rose-300 dark:hover:bg-rose-900/50">PDF</flux:button>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm font-medium text-teal-800 dark:border-teal-900/60 dark:bg-teal-950/40 dark:text-teal-200">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" class="grid gap-3 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-sky-100 sm:grid-cols-2 lg:grid-cols-3 dark:bg-slate-900 dark:ring-sky-900/60">
            <flux:input name="search" :value="request('search')" placeholder="Cari nomor polisi, merek, pemakai..." icon="magnifying-glass" />
            <select name="kategori" class="rounded-xl border border-sky-200 bg-white px-3 py-2 text-sm text-slate-700 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-sky-900 dark:bg-slate-900 dark:text-slate-200">
                <option value="">Semua Kategori</option>
                @foreach ($kategoriList as $kategori)
                    <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                @endforeach
            </select>
            <select name="status" class="rounded-xl border border-sky-200 bg-white px-3 py-2 text-sm text-slate-700 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-sky-900 dark:bg-slate-900 dark:text-slate-200">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="non_aktif" {{ request('status') == 'non_aktif' ? 'selected' : '' }}>Non Aktif</option>
                <option value="perbaikan" {{ request('status') == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                <option value="dijual" {{ request('status') == 'dijual' ? 'selected' : '' }}>Dijual</option>
            </select>
        </form>

        <div class="overflow-x-auto rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
            <table class="w-full min-w-[980px]">
                <thead class="bg-gradient-to-r from-cyan-50 to-sky-50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-sky-800 dark:text-sky-200">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-sky-800 dark:text-sky-200">No Polisi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-sky-800 dark:text-sky-200">Merek / Tipe</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-sky-800 dark:text-sky-200">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-sky-800 dark:text-sky-200">Pemakai</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-sky-800 dark:text-sky-200">Pajak</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-sky-800 dark:text-sky-200">STNK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-sky-800 dark:text-sky-200">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wide text-sky-800 dark:text-sky-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sky-50 dark:divide-slate-800">
                    @forelse ($vehicles as $index => $vehicle)
                        <tr class="transition hover:bg-cyan-50/50 dark:hover:bg-cyan-950/20">
                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $vehicles->firstItem() + $index }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $vehicle->nomor_polisi }}</td>
                            <td class="px-4 py-3 text-sm text-slate-700 dark:text-slate-200"><div>{{ $vehicle->merek }}</div><div class="text-xs text-slate-500 dark:text-slate-400">{{ $vehicle->tipe }} / {{ $vehicle->jenis }}</div></td>
                            <td class="px-4 py-3 text-sm text-slate-700 dark:text-slate-200"><div>{{ $vehicle->kategori }}</div>@if ($vehicle->sub_kategori)<div class="text-xs text-slate-500 dark:text-slate-400">{{ $vehicle->sub_kategori }}</div>@endif</td>
                            <td class="px-4 py-3 text-sm text-slate-700 dark:text-slate-200"><div>{{ $vehicle->nama_pemakai }}</div><div class="text-xs text-slate-500 dark:text-slate-400">{{ $vehicle->jabatan_pemakai }}</div></td>
                            <td class="px-4 py-3 text-sm">
                                @if ($vehicle->isPajakExpired()) <flux:badge color="red">Expired</flux:badge>
                                @elseif ($vehicle->isPajakExpiringSoon()) <flux:badge color="cyan">{{ $vehicle->masa_berlaku_pajak->format('d/m/Y') }}</flux:badge>
                                @else <span class="text-xs text-slate-600 dark:text-slate-300">{{ $vehicle->masa_berlaku_pajak->format('d/m/Y') }}</span> @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($vehicle->isStnkExpired()) <flux:badge color="red">Expired</flux:badge>
                                @else <span class="text-xs text-slate-600 dark:text-slate-300">{{ $vehicle->masa_berlaku_stnk->format('d/m/Y') }}</span> @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($vehicle->status === 'aktif') <flux:badge color="teal">Aktif</flux:badge>
                                @elseif ($vehicle->status === 'perbaikan') <flux:badge color="cyan">Perbaikan</flux:badge>
                                @elseif ($vehicle->status === 'dijual') <flux:badge color="red">Dijual</flux:badge>
                                @else <flux:badge color="zinc">Non Aktif</flux:badge> @endif
                            </td>
                            <td class="px-4 py-3 text-center"><div class="flex items-center justify-center gap-1"><flux:button size="xs" :href="route('vehicles.show', $vehicle->id)" icon="eye" square variant="ghost" class="text-sky-700 hover:bg-sky-100 dark:text-sky-300 dark:hover:bg-sky-900/50" /><flux:button size="xs" :href="route('vehicles.edit', $vehicle->id)" icon="pencil" square variant="ghost" class="text-teal-700 hover:bg-teal-100 dark:text-teal-300 dark:hover:bg-teal-900/50" /><form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<flux:button size="xs" type="submit" icon="trash" square variant="ghost" class="text-rose-600 hover:bg-rose-50 dark:text-rose-300 dark:hover:bg-rose-950/40" /></form></div></td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="px-4 py-10 text-center text-sm text-slate-500 dark:text-slate-400">Tidak ada data kendaraan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>{{ $vehicles->withQueryString()->links() }}</div>
    </div>
</x-layouts::app>
