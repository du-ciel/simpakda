<x-layouts::app :title="__('Penyusutan Kendaraan')">

    {{-- =========================================================
        AMBIENT BACKGROUND GLOW
    ========================================================== --}}

    <div class="fixed inset-0 z-[-1] bg-gradient-to-br from-[#bae6fd] via-[#e0f2fe] to-[#a5f3fc] dark:from-[#020617] dark:via-[#0f172a] dark:to-[#083344] pointer-events-none overflow-hidden">

        <div class="absolute -top-[20%] -left-[10%] w-[70vw] h-[70vw] max-w-[800px] max-h-[800px] rounded-full bg-cyan-500/20 blur-[120px] dark:bg-cyan-900/30"></div>

        <div class="absolute -bottom-[20%] -right-[10%] w-[60vw] h-[60vw] max-w-[600px] max-h-[600px] rounded-full bg-sky-500/20 blur-[120px] dark:bg-sky-900/30"></div>

    </div>


    <div class="relative mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-6 pb-8 z-0">

        {{-- =========================================================
            HEADER DASHBOARD
        ========================================================== --}}

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#111827] to-[#0b334d] px-6 py-8 text-white shadow-xl sm:px-10 border border-white/5">

            {{-- Ornamen --}}
            <div class="pointer-events-none absolute -right-12 -top-16 size-48 rounded-full border-[18px] border-white/5"></div>

            <div class="pointer-events-none absolute -bottom-24 right-24 size-56 rounded-full border-[22px] border-white/5"></div>

            <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between z-10">

                {{-- Judul --}}
                <div>

                    <div class="mb-2 flex items-center gap-2 text-cyan-400">

                        <flux:icon
                            name="calculator"
                            class="size-4"
                        />

                        <span class="text-xs font-bold uppercase tracking-[0.2em]">
                            Manajemen Aset
                        </span>

                    </div>

                    <flux:heading
                        size="xl"
                        class="text-white font-bold tracking-tight"
                    >
                        Penyusutan Kendaraan
                    </flux:heading>

                    <flux:text class="mt-2 text-slate-300 max-w-xl text-sm leading-relaxed">
                        Pengelolaan dan perhitungan penyusutan kendaraan berdasarkan kelompok aset.
                    </flux:text>

                </div>


                {{-- Export --}}
                <div class="flex flex-col gap-3 sm:items-end">

                    <div class="flex flex-wrap items-center gap-2">

                        <span class="text-xs font-medium text-slate-400 uppercase tracking-wider mr-1">
                            Export:
                        </span>

                        {{-- Excel --}}
                        <flux:button
                            size="sm"
                            :href="route(
                                'penyusutan.exportExcel',
                                request()->except('page')
                            )"
                            icon="table-cells"
                            class="!bg-white/10 !text-slate-200 !border-white/20 hover:!bg-white/20 backdrop-blur-md"
                        >
                            Excel
                        </flux:button>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            FLASH MESSAGE
        ========================================================== --}}

        @if (session()->has('success'))

            <div class="relative z-10 flex items-center gap-3 rounded-xl border border-teal-200 bg-white px-5 py-4 text-sm font-medium text-teal-800 shadow-md dark:border-teal-900/60 dark:bg-teal-950/40 dark:text-teal-200">

                <flux:icon
                    name="check-circle"
                    class="size-5 shrink-0 text-teal-500"
                />

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- =========================================================
            RINGKASAN PENYUSUTAN
        ========================================================== --}}

        <div class="relative z-10 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Total Kendaraan --}}
            <div class="rounded-2xl border border-white bg-white p-5 shadow-lg shadow-slate-300/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Total Kendaraan
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">
                            {{ $vehicles->total() }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Kendaraan terdaftar
                        </p>

                    </div>

                    <div class="flex size-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-900/30 dark:text-cyan-400">

                        <flux:icon
                            name="truck"
                            class="size-5"
                        />

                    </div>

                </div>

            </div>


            {{-- Total Nilai Perolehan --}}
            <div class="rounded-2xl border border-white bg-white p-5 shadow-lg shadow-slate-300/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="flex items-start justify-between">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Nilai Perolehan
                        </p>

                        <p class="mt-2 truncate text-xl font-bold text-slate-900 dark:text-white">
                            Rp {{ number_format($totalNilaiPerolehan, 0, ',', '.') }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Total nilai aset
                        </p>

                    </div>

                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600 dark:bg-sky-900/30 dark:text-sky-400">

                        <flux:icon
                            name="banknotes"
                            class="size-5"
                        />

                    </div>

                </div>

            </div>


            {{-- Akumulasi Penyusutan --}}
            <div class="rounded-2xl border border-white bg-white p-5 shadow-lg shadow-slate-300/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="flex items-start justify-between">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Akumulasi Penyusutan
                        </p>

                        <p class="mt-2 truncate text-xl font-bold text-slate-900 dark:text-white">
                            Rp {{ number_format($totalPenyusutan, 0, ',', '.') }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Total penyusutan
                        </p>

                    </div>

                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">

                        <flux:icon
                            name="chart-bar"
                            class="size-5"
                        />

                    </div>

                </div>

            </div>


            {{-- Nilai Buku --}}
            <div class="rounded-2xl border border-white bg-white p-5 shadow-lg shadow-slate-300/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="flex items-start justify-between">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Total Nilai Buku
                        </p>

                        <p class="mt-2 truncate text-xl font-bold text-slate-900 dark:text-white">
                            Rp {{ number_format($totalNilaiBuku, 0, ',', '.') }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Nilai aset saat ini
                        </p>

                    </div>

                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-900/30 dark:text-teal-400">

                        <flux:icon
                            name="building-library"
                            class="size-5"
                        />

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            FILTER & PENCARIAN
        ========================================================== --}}

        <form
            method="GET"
            action="{{ route('penyusutan.index') }}"
            id="filter-form"
            class="relative z-10 grid gap-4 rounded-2xl border border-white bg-white p-5 shadow-lg shadow-slate-300/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        >

            {{-- Kelompok Penyusutan --}}
            <div class="relative">

                <select
                    name="sumber_kendaraan"
                    id="filter-sumber"
                    onchange="this.form.submit()"
                    class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
                >

                    <option value="">
                        Semua Sumber Kendaraan
                    </option>

                    @foreach ($sumberList as $sumber)

                        <option
                            value="{{ $sumber }}"
                            @selected(request('sumber_kendaraan') === $sumber)
                        >
                            {{ $sumber }}
                        </option>

                    @endforeach

                </select>

                <flux:icon
                    name="chevron-down"
                    class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-slate-400"
                />

            </div>


            {{-- Kategori --}}
            <div class="relative">

                <select
                    name="kategori"
                    id="filter-kategori"
                    onchange="this.form.submit()"
                    class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
                >

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach ($kategoriList as $kategori)

                        <option
                            value="{{ $kategori }}"
                            @selected(request('kategori') === $kategori)
                        >
                            {{ $kategori }}
                        </option>

                    @endforeach

                </select>

                <flux:icon
                    name="chevron-down"
                    class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-slate-400"
                />

            </div>


            {{-- Tahun --}}
            <div class="relative">

                <select
                    name="tahun_pemakaian"
                    id="filter-tahun"
                    onchange="this.form.submit()"
                    class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
                >

                    <option value="">
                        Semua Tahun Pemakaian
                    </option>

                    @foreach ($tahunList as $tahun)

                        <option
                            value="{{ $tahun }}"
                            @selected(request('tahun_pemakaian') == $tahun)
                        >
                            {{ $tahun }}
                        </option>

                    @endforeach

                </select>

                <flux:icon
                    name="chevron-down"
                    class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-slate-400"
                />

            </div>


            {{-- Reset --}}
            @if (
                request()->anyFilled([
                    'sumber_kendaraan',
                    'kategori',
                    'tahun_pemakaian',
                ])
            )

                <flux:button
                    type="button"
                    :href="route('penyusutan.index')"
                    icon="x-circle"
                    variant="danger"
                    size="sm"
                    class="self-center justify-self-start"
                >
                    Reset Filter
                </flux:button>

            @endif

        </form>


        {{-- =========================================================
            TABEL PENYUSUTAN
        ========================================================== --}}

        <div class="relative z-10 overflow-hidden rounded-2xl border border-white bg-white shadow-lg shadow-slate-300/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

            {{-- Header tabel --}}
            <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h3 class="font-semibold text-slate-900 dark:text-white">
                            Daftar Penyusutan Kendaraan
                        </h3>

                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            Perhitungan nilai penyusutan dan nilai buku kendaraan.
                        </p>

                    </div>

                    <div class="text-xs text-slate-500 dark:text-slate-400">

                        Total:
                        <span class="font-semibold text-slate-700 dark:text-slate-200">
                            {{ $vehicles->total() }}
                        </span>
                        kendaraan

                    </div>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full min-w-[1250px] text-left text-sm text-slate-600 dark:text-slate-300">

                    <thead class="border-b border-slate-100 bg-slate-50/80 text-slate-700 dark:border-slate-800 dark:bg-slate-800/50 dark:text-slate-300">

                        <tr>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                No
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                Kendaraan
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                Tahun Kendaraan
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                Kelompok
                            </th>

                            <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider">
                                Nilai Perolehan
                            </th>

                            <th class="px-5 py-4 text-center text-xs font-semibold uppercase tracking-wider">
                                Umur Aset
                            </th>

                            <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider">
                                Penyusutan / Tahun
                            </th>

                            <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider">
                                Akumulasi
                            </th>

                            <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider">
                                Nilai Buku
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-5 py-4 text-center text-xs font-semibold uppercase tracking-wider">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                        @forelse ($vehicles as $index => $vehicle)

                            @php

                                $kelompok = (int) ($vehicle->depreciation?->kelompok_penyusutan ?? 0);

                                $nilaiPerolehan = (float) ($vehicle->nilai_perolehan_hitung ?? 0);

                                $umurAset = (int) ($vehicle->umur_aset_hitung ?? 0);

                                $penyusutanTahunan = (float) ($vehicle->penyusutan_tahunan_hitung ?? 0);

                                $akumulasiPenyusutan = (float) ($vehicle->akumulasi_penyusutan_hitung ?? 0);

                                $nilaiBuku = (float) ($vehicle->nilai_buku_hitung ?? 0);

                                $status = $vehicle->status_penyusutan_hitung ?? 'Belum Ada Data Penyusutan';

                                $statusColor = match ($status) {
                                    'Penyusutan Maksimal' => 'green',
                                    'Dalam Penyusutan' => 'cyan',
                                    'Belum Mulai Penyusutan' => 'yellow',
                                    'Tidak Ada Nilai Perolehan' => 'red',
                                    'Tahun Perolehan Tidak Valid',
                                    'Masa Manfaat Tidak Valid' => 'orange',
                                    default => 'zinc',
                                };

                                $statusLabel = match ($status) {
                                    'Penyusutan Maksimal' => 'Maksimal',
                                    'Dalam Penyusutan' => 'Dalam Penyusutan',
                                    'Belum Mulai Penyusutan' => 'Belum Mulai',
                                    'Tidak Ada Nilai Perolehan' => 'Tidak Ada Nilai',
                                    'Tahun Perolehan Tidak Valid' => 'Tahun Tidak Valid',
                                    'Masa Manfaat Tidak Valid' => 'Masa Manfaat Tidak Valid',
                                    default => 'Belum Ada Data',
                                };

                            @endphp


                            <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">

                                {{-- No --}}
                                <td class="px-5 py-4 text-slate-500 dark:text-slate-400">

                                    {{ ($vehicles->firstItem() ?? 1) + $index }}

                                </td>


                                {{-- Kendaraan --}}
                                <td class="px-5 py-4">

                                    <div class="font-semibold text-slate-900 dark:text-slate-100">
                                        {{ $vehicle->nomor_polisi }}
                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                                        {{ $vehicle->merek }}
                                        @if ($vehicle->tipe)
                                            / {{ $vehicle->tipe }}
                                        @endif
                                    </div>

                                    @if ($vehicle->jenis)

                                        <div class="mt-1">

                                            <span class="text-[11px] text-slate-400">
                                                {{ $vehicle->jenis }}
                                            </span>

                                        </div>

                                    @endif

                                </td>


                                {{-- Tahun --}}
                                <td class="px-5 py-4">

                                    <span class="font-medium text-slate-800 dark:text-slate-200">
                                        {{ $vehicle->tahun_pemakaian ?? '-' }}
                                    </span>

                                </td>


                                {{-- Kelompok --}}
                                <td class="px-5 py-4">

                                    @if ($kelompok === 1)

                                        <flux:badge
                                            color="cyan"
                                            size="sm"
                                        >
                                            Kelompok 1
                                        </flux:badge>

                                        <div class="mt-1 text-[11px] text-slate-400">
                                            Motor
                                        </div>

                                    @elseif ($kelompok === 2)

                                        <flux:badge
                                            color="sky"
                                            size="sm"
                                        >
                                            Kelompok 2
                                        </flux:badge>

                                        <div class="mt-1 text-[11px] text-slate-400">
                                            Mobil
                                        </div>

                                    @else

                                        <flux:badge
                                            color="zinc"
                                            size="sm"
                                        >
                                            Belum Ada
                                        </flux:badge>

                                    @endif

                                </td>


                                {{-- Nilai Perolehan --}}
                                <td class="px-5 py-4 text-right">

                                    <span class="font-medium whitespace-nowrap text-slate-800 dark:text-slate-200">
                                        Rp {{ number_format($nilaiPerolehan, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- Umur --}}
                                <td class="px-5 py-4 text-center">

                                    <span class="font-semibold text-slate-800 dark:text-slate-200">
                                        {{ $umurAset }}
                                    </span>

                                    <span class="text-xs text-slate-400">
                                        th
                                    </span>

                                </td>


                                {{-- Penyusutan Tahunan --}}
                                <td class="px-5 py-4 text-right">

                                    <span class="font-medium whitespace-nowrap text-slate-800 dark:text-slate-200">
                                        Rp {{ number_format($penyusutanTahunan, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- Akumulasi --}}
                                <td class="px-5 py-4 text-right">

                                    <span class="font-medium whitespace-nowrap text-amber-700 dark:text-amber-400">
                                        Rp {{ number_format($akumulasiPenyusutan, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- Nilai Buku --}}
                                <td class="px-5 py-4 text-right">

                                    <span class="font-semibold whitespace-nowrap text-teal-700 dark:text-teal-400">
                                        Rp {{ number_format($nilaiBuku, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-4">

                                    <flux:badge
                                        :color="$statusColor"
                                        size="sm"
                                    >
                                        {{ $statusLabel }}
                                    </flux:badge>

                                </td>


                                {{-- Aksi --}}
                                <td class="px-5 py-4 text-center">

                                    <div class="flex items-center justify-center gap-1.5">

                                        {{-- Edit Penyusutan --}}
                                        <flux:button
                                            size="sm"
                                            :href="route(
                                                'penyusutan.edit',
                                                array_merge(
                                                    ['vehicle' => $vehicle->id],
                                                    request()->only([
                                                        'sumber_kendaraan',
                                                        'kategori',
                                                        'tahun_pemakaian',
                                                        'page'
                                                    ])
                                                )
                                            )"
                                            icon="pencil"
                                            square
                                            variant="ghost"
                                            class="!text-slate-400 hover:!text-teal-600 hover:!bg-teal-50 dark:hover:!text-teal-400 dark:hover:!bg-teal-900/30"
                                        />

                                    </div>

                                </td>

                            </tr>

                        @empty

                            {{-- Data kosong --}}
                            <tr>

                                <td
                                    colspan="11"
                                    class="px-5 py-12 text-center text-slate-500"
                                >

                                    <div class="flex flex-col items-center justify-center">

                                        <div class="mb-3 flex size-12 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800">

                                            <flux:icon
                                                name="inbox"
                                                class="size-6 text-slate-400 dark:text-slate-500"
                                            />

                                        </div>

                                        <span class="text-sm font-medium">
                                            Tidak ada data penyusutan kendaraan ditemukan.
                                        </span>

                                        <span class="mt-1 text-xs text-slate-400">
                                            Coba ubah atau reset filter yang digunakan.
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>


                    {{-- =====================================================
                        FOOTER TOTAL
                    ====================================================== --}}

                    @if ($vehicles->count() > 0)

                        <tfoot class="border-t border-slate-200 bg-slate-50/80 dark:border-slate-700 dark:bg-slate-800/50">

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300"
                                >
                                    Total Penyusutan / Tahun
                                </td>

                                <td class="px-5 py-4 text-right">

                                    <span class="font-bold whitespace-nowrap text-slate-900 dark:text-white">
                                        Rp {{ number_format($totalPenyusutanTahunan, 0, ',', '.') }}
                                    </span>

                                </td>

                                <td colspan="4"></td>

                            </tr>

                        </tfoot>

                    @endif

                </table>

            </div>


            {{-- =========================================================
                PAGINATION
            ========================================================== --}}

            @if ($vehicles->hasPages())

                <div class="border-t border-slate-100 px-6 py-4 dark:border-slate-800">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div class="text-sm text-slate-500 dark:text-slate-400">

                            Menampilkan

                            <span class="font-semibold text-slate-700 dark:text-slate-200">
                                {{ $vehicles->firstItem() ?? 0 }}
                            </span>

                            sampai

                            <span class="font-semibold text-slate-700 dark:text-slate-200">
                                {{ $vehicles->lastItem() ?? 0 }}
                            </span>

                            dari

                            <span class="font-semibold text-slate-700 dark:text-slate-200">
                                {{ $vehicles->total() }}
                            </span>

                            kendaraan

                        </div>

                        <div>
                            {{ $vehicles->onEachSide(1)->links() }}
                        </div>

                    </div>

                </div>

            @endif

        </div>
        {{-- =========================================================
            ATURAN PENYUSUTAN
        ========================================================== --}}

        <div class="relative z-10 overflow-hidden rounded-2xl border border-white bg-white shadow-lg shadow-slate-300/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

            <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800">

                <div class="flex items-center gap-3">

                    <div class="flex size-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-900/30 dark:text-cyan-400">

                        <flux:icon
                            name="scale"
                            class="size-5"
                        />

                    </div>

                    <div>

                        <h3 class="font-semibold text-slate-900 dark:text-white">
                            Aturan Penyusutan
                        </h3>

                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            Ketentuan masa manfaat dan tarif penyusutan kendaraan.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-4 p-6 sm:grid-cols-2">

                @foreach ($aturanPenyusutan as $kelompok => $aturan)

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/50">

                        <div class="flex items-center justify-between gap-3">

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    Kelompok {{ $kelompok }}
                                </p>

                                <p class="mt-1 font-semibold text-slate-900 dark:text-white">
                                    @if ((int) $kelompok === 1)
                                        Kendaraan Bermotor Roda Dua
                                    @elseif ((int) $kelompok === 2)
                                        Kendaraan Bermotor Roda Empat
                                    @else
                                        Kelompok {{ $kelompok }}
                                    @endif
                                </p>

                            </div>

                            <flux:badge
                                color="cyan"
                                size="sm"
                            >
                                {{ $aturan['tarif_persen'] }}% / tahun
                            </flux:badge>

                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-3">

                            <div class="rounded-lg bg-white p-3 dark:bg-slate-900">

                                <p class="text-[11px] uppercase tracking-wide text-slate-400">
                                    Masa Manfaat
                                </p>

                                <p class="mt-1 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $aturan['masa_manfaat'] }} tahun
                                </p>

                            </div>

                            <div class="rounded-lg bg-white p-3 dark:bg-slate-900">

                                <p class="text-[11px] uppercase tracking-wide text-slate-400">
                                    Tarif Tahunan
                                </p>

                                <p class="mt-1 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $aturan['tarif_persen'] }}%
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>


        {{-- =========================================================
            INFORMASI PERHITUNGAN
        ========================================================== --}}

        <div class="relative z-10 grid gap-4 lg:grid-cols-2">

            {{-- Metode --}}
            <div class="rounded-2xl border border-white bg-white p-6 shadow-lg shadow-slate-300/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="flex items-start gap-4">

                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-900/30 dark:text-cyan-400">

                        <flux:icon
                            name="information-circle"
                            class="size-5"
                        />

                    </div>

                    <div>

                        <h3 class="font-semibold text-slate-900 dark:text-white">
                            Metode Perhitungan
                        </h3>

                        <div class="mt-3 space-y-2 text-sm leading-relaxed text-slate-600 dark:text-slate-400">

                            <p>
                                Penyusutan dihitung menggunakan
                                <strong class="text-slate-800 dark:text-slate-200">
                                    metode garis lurus
                                </strong>
                                berdasarkan nilai perolehan dan masa manfaat aset.
                            </p>

                            <p>
                                Masa manfaat maksimal yang digunakan dalam perhitungan adalah
                                <strong class="text-slate-800 dark:text-slate-200">
                                    10 tahun
                                </strong>.
                            </p>

                            <p>
                                Kendaraan dengan umur lebih dari 10 tahun tetap menggunakan batas
                                penyusutan maksimal 10 tahun.
                            </p>

                            <p>
                                Nilai buku tidak akan dihitung menjadi nilai negatif.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Tarif --}}
            <div class="rounded-2xl border border-white bg-white p-6 shadow-lg shadow-slate-300/40 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20">

                <div class="flex items-start gap-4">

                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600 dark:bg-sky-900/30 dark:text-sky-400">

                        <flux:icon
                            name="calculator"
                            class="size-5"
                        />

                    </div>

                    <div class="w-full">

                        <h3 class="font-semibold text-slate-900 dark:text-white">
                            Dasar Tarif Penyusutan
                        </h3>

                        <div class="mt-4 space-y-3">

                            {{-- Motor --}}
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3 dark:bg-slate-800/50">

                                <div>

                                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">
                                        Kelompok 1 — Motor
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        Masa manfaat maksimal 10 tahun
                                    </p>

                                </div>

                                <span class="font-bold text-cyan-600 dark:text-cyan-400">
                                    6,25% / tahun
                                </span>

                            </div>


                            {{-- Mobil --}}
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3 dark:bg-slate-800/50">

                                <div>

                                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">
                                        Kelompok 2 — Mobil & Kapal
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        Masa manfaat maksimal 10 tahun
                                    </p>

                                </div>

                                <span class="font-bold text-sky-600 dark:text-sky-400">
                                    1,5625% / tahun
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            REFERENSI
        ========================================================== --}}

        <div class="relative z-10 rounded-2xl border border-cyan-100 bg-cyan-50/70 px-5 py-4 dark:border-cyan-900/50 dark:bg-cyan-950/30">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-start gap-3">

                    <flux:icon
                        name="book-open"
                        class="mt-0.5 size-5 shrink-0 text-cyan-600 dark:text-cyan-400"
                    />

                    <div>

                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">
                            Referensi Penyusutan
                        </p>

                        <p class="mt-1 text-xs leading-relaxed text-slate-600 dark:text-slate-400">
                            Informasi lebih lanjut mengenai penyusutan dan amortisasi dapat
                            dilihat pada referensi resmi Direktorat Jenderal Pajak.
                        </p>

                    </div>

                </div>

<div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-3">


                <a
                    href="https://pajak.go.id/id/penyusutan-dan-amortisasi"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex shrink-0 items-center gap-2 text-sm font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-400 dark:hover:text-cyan-300"
                >

                    Lihat Referensi

                    <flux:icon
                        name="arrow-top-right-on-square"
                        class="size-4"
                    />

                </a>
                <a
                    href="https://share.google/eTfhb93LATSSh3msZ"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex shrink-0 items-center gap-2 text-sm font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-400 dark:hover:text-cyan-300"
                >

                    Lihat Referensi

                    <flux:icon
                        name="arrow-top-right-on-square"
                        class="size-4"
                    />

                </a>
                <a
                    href="https://share.google/Pt5J4IYAywJlU4FzZ"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex shrink-0 items-center gap-2 text-sm font-semibold text-cyan-700 transition hover:text-cyan-900 dark:text-cyan-400 dark:hover:text-cyan-300"
                >

                    Lihat Referensi

                    <flux:icon
                        name="arrow-top-right-on-square"
                        class="size-4"
                    />

                </a>

                </div>

            </div>

        </div>


        {{-- =========================================================
            FOOTER
        ========================================================== --}}

        <div class="relative z-10 flex flex-col items-center justify-between gap-2 border-t border-slate-200/70 pt-5 text-xs text-slate-400 dark:border-slate-800 sm:flex-row">

            <p>
                SIMPAKDA · Modul Penyusutan Kendaraan
            </p>

            <p>
                Tahun {{ $tahunSekarang }}
            </p>

        </div>

    </div>

</x-layouts::app>