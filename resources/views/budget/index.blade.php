<x-layouts::app :title="__('Anggaran')">

    {{-- =========================================================
        AMBIENT BACKGROUND GLOW
    ========================================================== --}}
    <div class="fixed inset-0 z-[-1] bg-gradient-to-br from-[#b9edf9] via-[#e8f8fc] to-[#d8f1f8] dark:from-[#061827] dark:via-[#0b2235] dark:to-[#0a3045] pointer-events-none overflow-hidden">
        <div class="absolute -top-[20%] -left-[10%] w-[70vw] h-[70vw] max-w-[800px] max-h-[800px] rounded-full bg-cyan-400/15 blur-[120px] dark:bg-cyan-900/20"></div>
        <div class="absolute -bottom-[20%] -right-[10%] w-[60vw] h-[60vw] max-w-[600px] max-h-[600px] rounded-full bg-sky-400/15 blur-[120px] dark:bg-sky-900/20"></div>
    </div>

    <div class="relative mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-6 pb-12 z-0">

        {{-- ==========================================
    HEADER HALAMAN
=========================================== --}}
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#111827] via-[#12314a] to-[#0b3b55] px-6 py-8 text-white shadow-xl sm:px-10 border border-white/10">

    {{-- Ornamen --}}
    <div class="pointer-events-none absolute -right-12 -top-16 size-48 rounded-full border-[18px] border-white/5"></div>
    <div class="pointer-events-none absolute -bottom-24 right-24 size-56 rounded-full border-[22px] border-white/5"></div>

    {{-- Konten Header --}}
    <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

        {{-- Judul --}}
        <div>
            <div class="mb-2 flex items-center gap-2 text-cyan-400">
                <flux:icon
                    name="calculator"
                    class="size-4"
                />

                <span class="text-xs font-bold uppercase tracking-[0.2em]">
                    Keuangan
                </span>
            </div>

            <flux:heading
                size="xl"
                class="text-white font-bold tracking-tight"
            >
                Anggaran
            </flux:heading>

            <flux:text
                class="mt-2 max-w-xl text-slate-300 text-sm leading-relaxed"
            >
                Rincian anggaran dan biaya pajak kendaraan per-unit.
            </flux:text>
        </div>

        {{-- Tombol Cetak PDF --}}
        <div class="relative z-10 shrink-0 lg:self-center">

            <flux:button
                :href="route(
                    'anggaran.export-pdf',
                    request()->only(['sumber', 'kategori'])
                )"
                icon="printer"
                variant="primary"
                class="w-full bg-cyan-500 text-white shadow-lg shadow-cyan-500/20 ring-1 ring-cyan-300/20 transition-all hover:-translate-y-0.5 hover:bg-cyan-400 hover:shadow-cyan-400/30 sm:w-auto"
            >
                Cetak PDF
            </flux:button>

        </div>

    </div>

</div>

        {{-- ==========================================
            SUMMARY CARDS
        =========================================== --}}
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- TOTAL KENDARAAN --}}
            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-md shadow-slate-900/5 border border-slate-100 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-900/10 dark:bg-slate-900/95 dark:border-slate-800 dark:shadow-black/20">
                <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl bg-gradient-to-r from-blue-500 to-cyan-500"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="relative flex size-14 shrink-0 items-center justify-center rounded-2xl bg-sky-50 dark:bg-sky-900/30 transition-transform duration-300 group-hover:scale-110 group-hover:-translate-y-0.5">
                        <flux:icon name="truck" class="size-7 text-sky-600 dark:text-sky-400" />
                    </div>
                    <div class="min-w-0 text-left">
                        <flux:heading size="xl" class="font-bold text-slate-900 dark:text-white">
                            {{ $totalKendaraan }}
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 font-medium text-slate-500 dark:text-slate-400">
                            Total Kendaraan
                        </flux:text>
                    </div>
                </div>
            </div>

            {{-- TOTAL ANGGARAN --}}
            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-md shadow-slate-900/5 border border-slate-100 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-900/10 dark:bg-slate-900/95 dark:border-slate-800 dark:shadow-black/20">
                <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl bg-gradient-to-r from-blue-500 to-sky-500"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="relative flex size-14 shrink-0 items-center justify-center rounded-2xl bg-sky-50 dark:bg-sky-900/30 transition-transform duration-300 group-hover:scale-110 group-hover:-translate-y-0.5">
                        <flux:icon name="banknotes" class="size-7 text-sky-600 dark:text-sky-400" />
                    </div>
                    <div class="min-w-0 text-left">
                        <flux:heading size="lg" class="font-bold text-slate-900 dark:text-white leading-tight">
                            Rp {{ number_format((float) $totalAnggaran, 0, ',', '.') }}
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 font-medium text-slate-500 dark:text-slate-400">
                            Total Anggaran
                        </flux:text>
                    </div>
                </div>
            </div>

            {{-- TOTAL BIAYA PLAT/STNK --}}
            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-md shadow-slate-900/5 border border-slate-100 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-900/10 dark:bg-slate-900/95 dark:border-slate-800 dark:shadow-black/20">
                <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl bg-gradient-to-r from-cyan-500 to-sky-500"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="relative flex size-14 shrink-0 items-center justify-center rounded-2xl bg-cyan-50 dark:bg-cyan-900/30 transition-transform duration-300 group-hover:scale-110 group-hover:-translate-y-0.5">
                        <flux:icon name="identification" class="size-7 text-sky-600 dark:text-sky-400" />
                    </div>
                    <div class="min-w-0 text-left">
                        <flux:heading size="lg" class="font-bold text-slate-900 dark:text-white leading-tight">
                            Rp {{ number_format((float) $totalPlatStnk, 0, ',', '.') }}
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 font-medium text-slate-500 dark:text-slate-400">
                            Biaya Plat / STNK
                        </flux:text>
                    </div>
                </div>
            </div>

            {{-- TOTAL KESELURUHAN --}}
            <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-md shadow-slate-900/5 border border-slate-100 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-900/10 dark:bg-slate-900/95 dark:border-slate-800 dark:shadow-black/20">
                <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl bg-gradient-to-r from-sky-500 to-blue-600"></div>
                <div class="flex items-center gap-4 pt-1">
                    <div class="relative flex size-14 shrink-0 items-center justify-center rounded-2xl bg-sky-50 dark:bg-sky-900/30 transition-transform duration-300 group-hover:scale-110 group-hover:-translate-y-0.5">
                        <flux:icon name="calculator" class="size-7 text-sky-600 dark:text-sky-400" />
                    </div>
                    <div class="min-w-0 text-left">
                        <flux:heading size="lg" class="font-bold text-slate-900 dark:text-white leading-tight">
                            Rp {{ number_format((float) $totalBiaya, 0, ',', '.') }}
                        </flux:heading>
                        <flux:text size="sm" class="mt-0.5 font-medium text-slate-500 dark:text-slate-400">
                            Total Keseluruhan
                        </flux:text>
                    </div>
                </div>
            </div>

        </div>

{{-- =========================================================
    FILTER ANGGARAN
========================================================== --}}
<form
    method="GET"
    action="{{ route('anggaran') }}"
    id="budget-filter-form"
    class="relative z-10 grid gap-4 rounded-2xl bg-white p-5 shadow-lg shadow-slate-300/40 border border-white sm:grid-cols-2 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20"
>

    {{-- FILTER SUMBER KENDARAAN --}}
    <div class="relative">
        <label
            for="filter-sumber"
            class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400"
        >
            Sumber Kendaraan
        </label>

        <select
            name="sumber"
            id="filter-sumber"
            onchange="this.form.submit()"
            class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 pr-10 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
        >
            <option value="">
                Semua Sumber
            </option>

            <option
                value="APBD"
                @selected(request('sumber') === 'APBD')
            >
                APBD
            </option>

            <option
                value="APBN"
                @selected(request('sumber') === 'APBN')
            >
                APBN
            </option>
        </select>

        <flux:icon
            name="chevron-down"
            class="pointer-events-none absolute right-3 bottom-3 size-4 text-slate-400"
        />
    </div>


    {{-- FILTER KATEGORI KENDARAAN --}}
    <div class="relative">
        <label
            for="filter-kategori"
            class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400"
        >
            Jenis Kendaraan
        </label>

        <select
            name="kategori"
            id="filter-kategori"
            onchange="this.form.submit()"
            class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 pr-10 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
        >
            <option value="">
                Semua Jenis Kendaraan
            </option>

            <option
                value="roda_2"
                @selected(request('kategori') === 'roda_2')
            >
                Roda 2
            </option>

            <option
                value="roda_4"
                @selected(request('kategori') === 'roda_4')
            >
                Roda 4
            </option>
            <option
                value="kendaraan_laut"
                @selected(request('kategori') === 'kendaraan_laut')
            >
                Kendaraan Laut
            </option>
        </select>

        <flux:icon
            name="chevron-down"
            class="pointer-events-none absolute right-3 bottom-3 size-4 text-slate-400"
        />
    </div>


    {{-- RESET FILTER --}}
    @if (
        request()->filled('sumber') ||
        request()->filled('kategori')
    )
        <div class="sm:col-span-2">
            <flux:button
                type="button"
                :href="route('anggaran')"
                icon="x-circle"
                variant="danger"
                size="sm"
            >
                Reset Filter
            </flux:button>
        </div>
    @endif

</form>

        {{-- ==========================================
            TABEL RINCIAN ANGGARAN
        =========================================== --}}
        <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900/95 dark:border-slate-800 dark:shadow-black/20">
            <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50 px-6 py-4 dark:border-slate-800 dark:bg-slate-800/50">
                <flux:icon name="list-bullet" class="size-5 text-cyan-600 dark:text-cyan-400" />
                <flux:heading size="sm" class="font-bold text-slate-800 dark:text-slate-100">Rincian Anggaran per Kendaraan</flux:heading>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                        <tr>
                            <th scope="col" class="px-5 py-3.5 font-bold border-b border-slate-100 dark:border-slate-700">No</th>
                            <th scope="col" class="px-5 py-3.5 font-bold border-b border-slate-100 dark:border-slate-700">No. Polisi</th>
                            <th scope="col" class="px-5 py-3.5 font-bold border-b border-slate-100 dark:border-slate-700">Merek / Tipe</th>
                            <th scope="col" class="px-6 py-4 font-bold text-right border-b border-slate-100 dark:border-slate-700">Anggaran (Rp)</th>
                            <th scope="col" class="px-6 py-4 font-bold text-right border-b border-slate-100 dark:border-slate-700">Plat / STNK (Rp)</th>
                            <th scope="col" class="px-5 py-3.5 font-bold border-b border-slate-100 dark:border-slate-700">Pajak Expires</th>
                            <th scope="col" class="px-6 py-4 font-bold text-center border-b border-slate-100 dark:border-slate-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse ($vehicles as $vehicle)
                            <tr class="bg-white hover:bg-slate-50/70 dark:bg-slate-900 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-5 py-4 font-medium text-slate-500 dark:text-slate-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-4 font-semibold text-slate-900 dark:text-slate-100">
                                    {{ $vehicle->nomor_polisi }}
                                </td>
                                <td class="px-5 py-4 text-slate-700 dark:text-slate-300">
                                    {{ $vehicle->merek }} {{ $vehicle->tipe }}
                                </td>
                                <td class="px-5 py-4 text-right font-medium text-sky-600 dark:text-sky-400">
                                    {{ number_format((float) $vehicle->anggaran_biaya, 0, ',', '.') }}
                                </td>
                                <td class="px-5 py-4 text-right font-medium text-sky-600 dark:text-sky-400">
                                    {{ number_format((float) $vehicle->biaya_plat_stnk, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    {{ \Carbon\Carbon::parse($vehicle->masa_berlaku_pajak)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <flux:button size="xs" :href="route('vehicles.edit', $vehicle->id)" variant="primary" class="!text-xs">
                                        <flux:icon name="pencil-square" class="size-3.5" />
                                        Edit
                                    </flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-400 dark:text-slate-600">
                                    <flux:icon name="truck" class="mx-auto mb-3 size-10 text-slate-300 dark:text-slate-700" />
                                    <div class="font-medium">Belum ada data kendaraan</div>
                                    <div class="mt-1 text-sm">Tambahkan kendaraan terlebih dahulu.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($vehicles->count() > 0)
                        <tfoot class="bg-slate-50 text-xs uppercase text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                            <tr>
                                <th scope="row" colspan="3" class="px-6 py-4 font-bold text-slate-700 border-t border-slate-200 dark:border-slate-700 dark:text-slate-200">
                                    Total ({{ $vehicles->count() }} kendaraan)
                                </th>
                                <td class="px-5 py-4 text-right font-bold text-sky-600 border-t border-slate-200 dark:border-slate-700 dark:text-sky-400">
                                    {{ number_format((float) $totalAnggaran, 0, ',', '.') }}
                                </td>
                                <td class="px-5 py-4 text-right font-bold text-cyan-600 border-t border-slate-200 dark:border-slate-700 dark:text-cyan-400">
                                    {{ number_format((float) $totalPlatStnk, 0, ',', '.') }}
                                </td>
                                <td colspan="2" class="border-t border-slate-200 dark:border-slate-700"></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>

    </div>
</x-layouts::app>