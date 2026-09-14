<x-layouts::app :title="__('Data Kendaraan')">

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

            <div class="pointer-events-none absolute -right-12 -top-16 size-48 rounded-full border-[18px] border-white/5"></div>
            <div class="pointer-events-none absolute -bottom-24 right-24 size-56 rounded-full border-[22px] border-white/5"></div>

            <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between z-10">

                <div>
                    <div class="mb-2 flex items-center gap-2 text-cyan-400">
                        <flux:icon name="truck" class="size-4" />

                        <span class="text-xs font-bold uppercase tracking-[0.2em]">
                            Armada
                        </span>
                    </div>

                    <flux:heading
                        size="xl"
                        class="text-white font-bold tracking-tight"
                    >
                        Data Kendaraan
                    </flux:heading>

                    <flux:text class="mt-2 text-slate-300 max-w-xl text-sm leading-relaxed">
                        Kelola seluruh informasi kendaraan dalam satu tempat.
                    </flux:text>
                </div>


                <div class="flex flex-col gap-3 sm:items-end">

                    {{-- Tambah Kendaraan --}}
                    <flux:button
                        :href="route('vehicles.create')"
                        icon="plus"
                        class="!bg-cyan-500 !text-white hover:!bg-cyan-600 !border-transparent w-full sm:w-auto shadow-md"
                    >
                        Tambah Kendaraan
                    </flux:button>


                    {{-- Export --}}
                    <div class="flex flex-wrap items-center gap-2">

                        <span class="text-xs font-medium text-slate-400 uppercase tracking-wider mr-1">
                            Export:
                        </span>

                        {{-- Excel --}}
                        <flux:button
                            size="sm"
                            :href="route(
                                'vehicles.export',
                                array_merge(
                                    request()->except('page'),
                                    ['format' => 'xlsx']
                                )
                            )"
                            icon="table-cells"
                            class="!bg-white/10 !text-slate-200 !border-white/20 hover:!bg-white/20 backdrop-blur-md"
                        >
                            Excel
                        </flux:button>


                        {{-- CSV --}}
                        <flux:button
                            size="sm"
                            :href="route(
                                'vehicles.export',
                                array_merge(
                                    request()->except('page'),
                                    ['format' => 'csv']
                                )
                            )"
                            icon="document-text"
                            class="!bg-white/10 !text-slate-200 !border-white/20 hover:!bg-white/20 backdrop-blur-md"
                        >
                            CSV
                        </flux:button>


                        {{-- PDF --}}
                        <flux:button
                            size="sm"
                            :href="route(
                                'vehicles.export',
                                array_merge(
                                    request()->except('page'),
                                    ['format' => 'pdf']
                                )
                            )"
                            icon="document-arrow-down"
                            class="!bg-white/10 !text-slate-200 !border-white/20 hover:!bg-white/20 backdrop-blur-md"
                        >
                            PDF
                        </flux:button>

                    </div>
                </div>

            </div>
        </div>


        {{-- =========================================================
            FLASH MESSAGE
        ========================================================== --}}
        @if (session()->has('success'))

            <div class="flex items-center gap-3 rounded-xl border border-teal-200 bg-white px-5 py-4 text-sm font-medium text-teal-800 dark:border-teal-900/60 dark:bg-teal-950/40 dark:text-teal-200 relative z-10 shadow-md">

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
    FILTER & PENCARIAN
========================================================== --}}

<form
    method="GET"
    action="{{ route('vehicles.index') }}"
    id="filter-form"
    class="relative z-10 grid gap-4 rounded-2xl bg-white p-5 shadow-lg shadow-slate-300/40 border border-white sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20"
>

    {{-- =====================================================
        SEARCH
    ====================================================== --}}

    <flux:input
        name="search"
        :value="request('search')"
        placeholder="Cari nomor polisi, merek, pemakai..."
        icon="magnifying-glass"
    />

    {{-- =====================================================
        FILTER KATEGORI
    ====================================================== --}}

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

            @foreach ($kategoriList as $k)
                <option
                    value="{{ $k }}"
                    @selected(request('kategori') == $k)
                >
                    {{ $k }}
                </option>
            @endforeach
        </select>

        <flux:icon
            name="chevron-down"
            class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-slate-400"
        />
    </div>

    {{-- =====================================================
        FILTER STATUS
    ====================================================== --}}

    <div class="relative">
        <select
            name="status"
            id="filter-status"
            onchange="this.form.submit()"
            class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
        >
            <option value="">
                Semua Status Kendaraan
            </option>

            <option
                value="aktif"
                @selected(request('status') == 'aktif')
            >
                Aktif
            </option>

            <option
                value="non_aktif"
                @selected(request('status') == 'non_aktif')
            >
                Non Aktif
            </option>

            <option
                value="perbaikan"
                @selected(request('status') == 'perbaikan')
            >
                Perbaikan
            </option>

            <option
                value="dijual"
                @selected(request('status') == 'dijual')
            >
                Dijual
            </option>
        </select>

        <flux:icon
            name="chevron-down"
            class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-slate-400"
        />
    </div>

    {{-- =====================================================
        FILTER PAJAK / STNK
    ====================================================== --}}

    <div class="relative">
        <select
            name="pajak_stnk"
            id="filter-pajak-stnk"
            onchange="this.form.submit()"
            class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
        >
            <option value="">
                Semua Status Dokumen
            </option>

            <option
                value="pajak_expired"
                @selected(request('pajak_stnk') == 'pajak_expired')
            >
                Belum Bayar Pajak
            </option>

            <option
                value="stnk_expired"
                @selected(request('pajak_stnk') == 'stnk_expired')
            >
                Belum Bayar STNK
            </option>
        </select>

        <flux:icon
            name="chevron-down"
            class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-slate-400"
        />
    </div>

    {{-- =====================================================
        FILTER SUMBER
    ====================================================== --}}

    <div class="relative">
        <select
            name="sumber"
            id="filter-sumber"
            onchange="this.form.submit()"
            class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
        >
            <option value="">
                Semua Sumber
            </option>

            @foreach ($sumberList as $s)
                <option
                    value="{{ $s }}"
                    @selected(request('sumber') == $s)
                >
                    {{ $s }}
                </option>
            @endforeach
        </select>

        <flux:icon
            name="chevron-down"
            class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-slate-400"
        />
    </div>

    {{-- =====================================================
        FILTER TAHUN
    ====================================================== --}}

    <div class="relative">
        <select
            name="tahun"
            id="filter-tahun"
            onchange="this.form.submit()"
            class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
        >
            <option value="">
                Semua Tahun
            </option>

            @foreach ($tahunList as $t)
                <option
                    value="{{ $t }}"
                    @selected(request('tahun') == $t)
                >
                    {{ $t }}
                </option>
            @endforeach
        </select>

        <flux:icon
            name="chevron-down"
            class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-slate-400"
        />
    </div>

    {{-- =====================================================
        RESET FILTER
    ====================================================== --}}

    @if (
        request()->anyFilled([
            'search',
            'kategori',
            'status',
            'pajak_stnk',
            'sumber',
            'tahun',
        ])
    )
        <flux:button
            type="button"
            :href="route('vehicles.index')"
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
            TABEL DATA
        ========================================================== --}}
        <div class="relative z-10 overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-300/40 border border-white dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1000px] text-left text-sm text-slate-600 dark:text-slate-300">

                    <thead class="border-b border-slate-100 bg-slate-50/80 text-slate-700 dark:border-slate-800 dark:bg-slate-800/50 dark:text-slate-300">

                        <tr>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                No
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                No Polisi
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                Merek / Tipe
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                Kategori
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                Pemakai
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                Pajak
                            </th>

                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider">
                                STNK
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

                            <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">

                                {{-- =================================================
                                    NOMOR
                                ================================================== --}}
                                <td class="px-5 py-4 text-slate-500 dark:text-slate-400">

                                    {{ $vehicles->firstItem() + $index }}

                                </td>


                                {{-- =================================================
                                    NOMOR POLISI
                                ================================================== --}}
                                <td class="px-5 py-4 font-semibold text-slate-900 dark:text-slate-100">

                                    {{ $vehicle->nomor_polisi }}

                                </td>


                                {{-- =================================================
                                    MEREK / TIPE
                                ================================================== --}}
                                <td class="px-5 py-4">

                                    <div class="font-medium text-slate-800 dark:text-slate-200">
                                        {{ $vehicle->merek }}
                                    </div>

                                    <div class="text-xs text-slate-500">
                                        {{ $vehicle->tipe }} / {{ $vehicle->jenis }}
                                    </div>

                                </td>


                                {{-- =================================================
                                    KATEGORI
                                ================================================== --}}
                                <td class="px-5 py-4">

                                    <div class="font-medium text-slate-800 dark:text-slate-200">
                                        {{ $vehicle->kategori }}
                                    </div>

                                    @if ($vehicle->sub_kategori)

                                        <div class="text-xs text-slate-500">
                                            {{ $vehicle->sub_kategori }}
                                        </div>

                                    @endif

                                </td>


                                {{-- =================================================
                                    PEMAKAI
                                ================================================== --}}
                                <td class="px-5 py-4">

                                    <div class="font-medium text-slate-800 dark:text-slate-200">
                                        {{ $vehicle->nama_pemakai }}
                                    </div>

                                    <div class="text-xs text-slate-500">
                                        {{ $vehicle->jabatan_pemakai }}
                                    </div>

                                </td>


                                {{-- =================================================
                                    PAJAK
                                ================================================== --}}
                                <td class="px-5 py-4">

                                    @if ($vehicle->isPajakExpired())

                                        <flux:badge
                                            color="red"
                                            size="sm"
                                        >
                                            Belum Bayar
                                        </flux:badge>

                                    @elseif ($vehicle->isPajakExpiringSoon())

                                        <flux:badge
                                            color="amber"
                                            size="sm"
                                        >
                                            {{ $vehicle->masa_berlaku_pajak->format('d/m/Y') }}
                                        </flux:badge>

                                    @else

                                        <span class="text-xs font-medium">
                                            {{ $vehicle->masa_berlaku_pajak->format('d/m/Y') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    STNK
                                ================================================== --}}
                                <td class="px-5 py-4">

                                    @if ($vehicle->isStnkExpired())

                                        <flux:badge
                                            color="red"
                                            size="sm"
                                        >
                                            Belum Bayar
                                        </flux:badge>

                                    @else

                                        <span class="text-xs font-medium">
                                            {{ $vehicle->masa_berlaku_stnk->format('d/m/Y') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    STATUS
                                ================================================== --}}
                                <td class="px-5 py-4">

                                    @if ($vehicle->status === 'aktif')

                                        <flux:badge
                                            color="cyan"
                                            size="sm"
                                        >
                                            Aktif
                                        </flux:badge>

                                    @elseif ($vehicle->status === 'perbaikan')

                                        <flux:badge
                                            color="yellow"
                                            size="sm"
                                        >
                                            Perbaikan
                                        </flux:badge>

                                    @elseif ($vehicle->status === 'dijual')

                                        <flux:badge
                                            color="red"
                                            size="sm"
                                        >
                                            Dijual
                                        </flux:badge>

                                    @else

                                        <flux:badge
                                            color="zinc"
                                            size="sm"
                                        >
                                            Non Aktif
                                        </flux:badge>

                                    @endif

                                </td>


                                {{-- =================================================
                                    AKSI
                                ================================================== --}}
                                <td class="px-5 py-4 text-center">

                                    <div class="flex items-center justify-center gap-1.5">


                                        {{-- =================================================
                                            DETAIL
                                        ================================================== --}}
                                        <flux:button
                                            size="sm"
                                            :href="route(
                                                'vehicles.show',
                                                $vehicle->id
                                            )"
                                            icon="eye"
                                            square
                                            variant="ghost"
                                            class="!text-slate-400 hover:!text-cyan-600 hover:!bg-cyan-50 dark:hover:!text-cyan-400 dark:hover:!bg-cyan-900/30"
                                        />


                                        {{-- =================================================
                                            EDIT
                                            PERTAHANKAN FILTER + PAGE
                                        ================================================== --}}
                                        <flux:button
                                            size="sm"
                                            :href="route(
                                                'vehicles.edit',
                                                array_merge(
                                                    ['vehicle' => $vehicle->id],
                                                    request()->only([
                                                        'search',
                                                        'kategori',
                                                        'status',
                                                        'pajak_stnk',
                                                        'sumber',
                                                        'tahun',
                                                        'page'
                                                    ])
                                                )
                                            )"
                                            icon="pencil"
                                            square
                                            variant="ghost"
                                            class="!text-slate-400 hover:!text-teal-600 hover:!bg-teal-50 dark:hover:!text-teal-400 dark:hover:!bg-teal-900/30"
                                        />


                                        {{-- =================================================
                                            HAPUS
                                            PERTAHANKAN FILTER + PAGE
                                        ================================================== --}}
                                        <form
                                            action="{{ route('vehicles.destroy', $vehicle->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin hapus data kendaraan ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')


                                            {{-- Pertahankan filter --}}
                                            @foreach (
                                                request()->only([
                                                    'search',
                                                    'kategori',
                                                    'status',
                                                    'pajak_stnk',
                                                    'sumber',
                                                    'tahun',
                                                    'page'
                                                ]) as $key => $value
                                            )

                                                @if ($value !== null && $value !== '')

                                                    <input
                                                        type="hidden"
                                                        name="{{ $key }}"
                                                        value="{{ $value }}"
                                                    >

                                                @endif

                                            @endforeach


                                            <flux:button
                                                size="sm"
                                                type="submit"
                                                icon="trash"
                                                square
                                                variant="ghost"
                                                class="!text-slate-400 hover:!text-rose-600 hover:!bg-rose-50 dark:hover:!text-rose-400 dark:hover:!bg-rose-900/30"
                                            />

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            {{-- =================================================
                                DATA KOSONG
                            ================================================== --}}
                            <tr>

                                <td
                                    colspan="9"
                                    class="px-5 py-12 text-center text-slate-500"
                                >

                                    <div class="flex flex-col items-center justify-center">

                                        <div class="flex size-12 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 mb-3">

                                            <flux:icon
                                                name="inbox"
                                                class="size-6 text-slate-400 dark:text-slate-500"
                                            />

                                        </div>

                                        <span class="text-sm font-medium">
                                            Tidak ada data kendaraan ditemukan.
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =========================================================
            PAGINATION
        ========================================================== --}}
        <div class="mt-2 relative z-10">

            {{ $vehicles->appends(request()->except('page'))->links() }}

        </div>

    </div>

</x-layouts::app>