<x-layouts::app :title="__('Edit Penyusutan Kendaraan')">

    {{-- =========================================================
        AMBIENT BACKGROUND
    ========================================================== --}}

    <div
        class="fixed inset-0 z-[-1] overflow-hidden bg-gradient-to-br
               from-[#bae6fd] via-[#e0f2fe] to-[#a5f3fc]
               dark:from-[#020617] dark:via-[#0f172a] dark:to-[#083344]
               pointer-events-none"
    >
        <div
            class="absolute -left-[10%] -top-[20%]
                   h-[70vw] w-[70vw] max-h-[800px] max-w-[800px]
                   rounded-full bg-cyan-500/20 blur-[120px]
                   dark:bg-cyan-900/30"
        ></div>

        <div
            class="absolute -bottom-[20%] -right-[10%]
                   h-[60vw] w-[60vw] max-h-[600px] max-w-[600px]
                   rounded-full bg-sky-500/20 blur-[120px]
                   dark:bg-sky-900/30"
        ></div>
    </div>


    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="relative z-10 mb-6">

        <div
            class="overflow-hidden rounded-2xl
                   bg-gradient-to-r from-[#111827] to-[#0b334d]
                   shadow-lg shadow-slate-300/40
                   dark:shadow-black/20"
        >

            <div class="px-6 py-6 sm:px-8">

                <div
                    class="flex flex-col gap-4
                           sm:flex-row sm:items-center sm:justify-between"
                >

                    {{-- TITLE --}}
                    <div class="flex items-start gap-4">

                        <div
                            class="flex size-12 shrink-0 items-center justify-center
                                   rounded-xl bg-cyan-500/15
                                   ring-1 ring-cyan-400/20"
                        >
                            <flux:icon
                                name="calculator"
                                class="size-6 text-cyan-300"
                            />
                        </div>

                        <div>

                            <div class="mb-1 flex flex-wrap items-center gap-2">

                                <h1
                                    class="text-xl font-bold tracking-tight
                                           text-white sm:text-2xl"
                                >
                                    Edit Penyusutan Kendaraan
                                </h1>

                                <span
                                    class="rounded-full border border-cyan-400/20
                                           bg-cyan-400/10 px-2.5 py-1
                                           text-[10px] font-semibold uppercase
                                           tracking-wider text-cyan-300"
                                >
                                    Garis Lurus
                                </span>

                            </div>

                            <p class="max-w-2xl text-sm text-slate-300">
                                Atur data penyusutan kendaraan tanpa mengubah
                                data utama pada tabel kendaraan.
                            </p>

                        </div>

                    </div>


                    {{-- BACK BUTTON --}}
                    <div class="shrink-0">

                        <a
                            href="{{ route('penyusutan.index') }}"
                            class="inline-flex items-center gap-2 rounded-lg
                                   border border-white/10 bg-white/5
                                   px-4 py-2.5 text-sm font-semibold text-white
                                   transition hover:bg-white/10
                                   focus:outline-none focus:ring-2
                                   focus:ring-cyan-400/50"
                        >
                            <flux:icon
                                name="arrow-left"
                                class="size-4"
                            />

                            <span>Kembali</span>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERROR
    ========================================================== --}}

    @if ($errors->any())

        <div class="relative z-10 mb-6">

            <div
                class="rounded-2xl border border-red-200
                       bg-red-50 p-5 shadow-sm
                       dark:border-red-900/50
                       dark:bg-red-950/30"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="flex size-9 shrink-0 items-center justify-center
                               rounded-lg bg-red-100
                               dark:bg-red-900/40"
                    >
                        <flux:icon
                            name="exclamation-triangle"
                            class="size-5 text-red-600 dark:text-red-400"
                        />
                    </div>

                    <div class="min-w-0">

                        <h3
                            class="font-semibold text-red-800
                                   dark:text-red-300"
                        >
                            Terdapat kesalahan pada input
                        </h3>

                        <ul
                            class="mt-2 list-disc space-y-1 pl-5
                                   text-sm text-red-700
                                   dark:text-red-400"
                        >
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        FORM
    ========================================================== --}}

    <form
        method="POST"
        action="{{ route('penyusutan.update', $vehicle) }}"
        class="relative z-10"
    >

        @csrf
        @method('PUT')


        {{-- =====================================================
            INFORMASI KENDARAAN
        ====================================================== --}}

        <div
            class="mb-6 overflow-hidden rounded-2xl
                   border border-white bg-white
                   shadow-lg shadow-slate-300/40
                   dark:border-slate-800
                   dark:bg-slate-900
                   dark:shadow-black/20"
        >

            {{-- SECTION HEADER --}}
            <div
                class="border-b border-slate-100 px-5 py-4
                       dark:border-slate-800"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex size-9 items-center justify-center
                               rounded-lg bg-slate-100
                               dark:bg-slate-800"
                    >
                        <flux:icon
                            name="truck"
                            class="size-5 text-slate-600
                                   dark:text-slate-300"
                        />
                    </div>

                    <div>

                        <h2
                            class="font-semibold text-slate-900
                                   dark:text-white"
                        >
                            Informasi Kendaraan
                        </h2>

                        <p
                            class="mt-0.5 text-xs text-slate-500
                                   dark:text-slate-400"
                        >
                            Data berikut berasal dari tabel kendaraan dan
                            tidak dapat diubah di halaman ini.
                        </p>

                    </div>

                </div>

            </div>


            {{-- VEHICLE DATA --}}
            <div class="p-5 sm:p-6">

                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                    {{-- NO POLISI --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-semibold
                                   uppercase tracking-wide
                                   text-slate-500 dark:text-slate-400"
                        >
                            Nomor Polisi
                        </label>

                        <div
                            class="flex min-h-11 items-center rounded-xl
                                   border border-slate-200
                                   bg-slate-50 px-4
                                   text-sm font-semibold text-slate-800
                                   dark:border-slate-700
                                   dark:bg-slate-800/70
                                   dark:text-slate-200"
                        >
                            {{ $vehicle->nomor_polisi ?: '-' }}
                        </div>

                    </div>


                    {{-- MEREK --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-semibold
                                   uppercase tracking-wide
                                   text-slate-500 dark:text-slate-400"
                        >
                            Merek
                        </label>

                        <div
                            class="flex min-h-11 items-center rounded-xl
                                   border border-slate-200
                                   bg-slate-50 px-4
                                   text-sm text-slate-800
                                   dark:border-slate-700
                                   dark:bg-slate-800/70
                                   dark:text-slate-200"
                        >
                            {{ $vehicle->merek ?: '-' }}
                        </div>

                    </div>


                    {{-- TIPE --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-semibold
                                   uppercase tracking-wide
                                   text-slate-500 dark:text-slate-400"
                        >
                            Tipe
                        </label>

                        <div
                            class="flex min-h-11 items-center rounded-xl
                                   border border-slate-200
                                   bg-slate-50 px-4
                                   text-sm text-slate-800
                                   dark:border-slate-700
                                   dark:bg-slate-800/70
                                   dark:text-slate-200"
                        >
                            {{ $vehicle->tipe ?: '-' }}
                        </div>

                    </div>


                    {{-- JENIS --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-semibold
                                   uppercase tracking-wide
                                   text-slate-500 dark:text-slate-400"
                        >
                            Jenis
                        </label>

                        <div
                            class="flex min-h-11 items-center rounded-xl
                                   border border-slate-200
                                   bg-slate-50 px-4
                                   text-sm text-slate-800
                                   dark:border-slate-700
                                   dark:bg-slate-800/70
                                   dark:text-slate-200"
                        >
                            {{ $vehicle->jenis ?: '-' }}
                        </div>

                    </div>


                    {{-- KATEGORI --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-semibold
                                   uppercase tracking-wide
                                   text-slate-500 dark:text-slate-400"
                        >
                            Kategori
                        </label>

                        <div
                            class="flex min-h-11 items-center rounded-xl
                                   border border-slate-200
                                   bg-slate-50 px-4
                                   text-sm text-slate-800
                                   dark:border-slate-700
                                   dark:bg-slate-800/70
                                   dark:text-slate-200"
                        >
                            {{ $vehicle->kategori ?: '-' }}
                        </div>

                    </div>


                    {{-- TAHUN PEMAKAIAN --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-semibold
                                   uppercase tracking-wide
                                   text-slate-500 dark:text-slate-400"
                        >
                            Tahun Pemakaian
                        </label>

                        <div
                            class="flex min-h-11 items-center rounded-xl
                                   border border-slate-200
                                   bg-slate-50 px-4
                                   text-sm text-slate-800
                                   dark:border-slate-700
                                   dark:bg-slate-800/70
                                   dark:text-slate-200"
                        >
                            {{ $vehicle->tahun_pemakaian ?: '-' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            DATA PENYUSUTAN
        ====================================================== --}}

        <div
            class="mb-6 overflow-hidden rounded-2xl
                   border border-white bg-white
                   shadow-lg shadow-slate-300/40
                   dark:border-slate-800
                   dark:bg-slate-900
                   dark:shadow-black/20"
        >

            {{-- SECTION HEADER --}}
            <div
                class="border-b border-slate-100 px-5 py-4
                       dark:border-slate-800"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex size-9 items-center justify-center
                               rounded-lg bg-cyan-50
                               dark:bg-cyan-950/40"
                    >
                        <flux:icon
                            name="calculator"
                            class="size-5 text-cyan-600
                                   dark:text-cyan-400"
                        />
                    </div>

                    <div>

                        <h2
                            class="font-semibold text-slate-900
                                   dark:text-white"
                        >
                            Data Penyusutan
                        </h2>

                        <p
                            class="mt-0.5 text-xs text-slate-500
                                   dark:text-slate-400"
                        >
                            Data berikut akan disimpan pada tabel
                            <strong>depreciations</strong>.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <div class="grid gap-6 lg:grid-cols-2">


                    {{-- =================================================
                        NILAI PEROLEHAN
                    ================================================== --}}

                    <div class="lg:col-span-2">

                        <flux:field>

                            <flux:label>
                                Nilai Perolehan
                            </flux:label>

                            <flux:input
                                name="nilai_perolehan"
                                type="number"
                                min="0"
                                step="1"
                                value="{{ old(
                                    'nilai_perolehan',
                                    $vehicle->depreciation?->nilai_perolehan ?? 0
                                ) }}"
                                placeholder="Contoh: 15000000"
                                inputmode="numeric"
                            />

                            <flux:description>
                                Nilai aset dalam rupiah yang digunakan sebagai
                                dasar perhitungan penyusutan.
                                Masukkan angka rupiah tanpa titik dan tanpa koma,
                                misalnya
                                <strong>15000000</strong>
                                untuk Rp15.000.000.
                                Nilai ini <strong>tidak menggunakan</strong>
                                kolom <code>anggaran_biaya</code> pada kendaraan.
                            </flux:description>

                            @error('nilai_perolehan')
                                <flux:error>
                                    {{ $message }}
                                </flux:error>
                            @enderror

                        </flux:field>

                    </div>


                    {{-- =================================================
                        TAHUN PEROLEHAN
                    ================================================== --}}

                    <div>

                        <flux:field>

                            <flux:label>
                                Tahun Perolehan
                            </flux:label>

                            <flux:input
                                name="tahun_perolehan"
                                type="number"
                                min="1900"
                                max="{{ now()->year }}"
                                step="1"
                                value="{{ old(
                                    'tahun_perolehan',
                                    $vehicle->depreciation?->tahun_perolehan
                                    ?? $vehicle->tahun_pemakaian
                                ) }}"
                                placeholder="Contoh: {{ now()->year }}"
                            />

                            <flux:description>
                                Tahun kendaraan mulai menjadi aset yang disusutkan.
                            </flux:description>

                            @error('tahun_perolehan')
                                <flux:error>
                                    {{ $message }}
                                </flux:error>
                            @enderror

                        </flux:field>

                    </div>


                    {{-- =================================================
                        METODE
                    ================================================== --}}

                    <div>

                        <flux:field>

                            <flux:label>
                                Metode Penyusutan
                            </flux:label>

                            <flux:select name="metode_penyusutan">

                                <option
                                    value="garis_lurus"
                                    @selected(
                                        old(
                                            'metode_penyusutan',
                                            $vehicle->depreciation?->metode_penyusutan
                                            ?? 'garis_lurus'
                                        ) === 'garis_lurus'
                                    )
                                >
                                    Garis Lurus
                                </option>

                            </flux:select>

                            <flux:description>
                                Metode penyusutan yang digunakan saat ini
                                adalah metode garis lurus.
                            </flux:description>

                            @error('metode_penyusutan')
                                <flux:error>
                                    {{ $message }}
                                </flux:error>
                            @enderror

                        </flux:field>

                    </div>


                    {{-- =================================================
                        KELOMPOK PENYUSUTAN
                    ================================================== --}}

                    <div>

                        <flux:field>

                            <flux:label>
                                Kelompok Penyusutan
                            </flux:label>

                            <flux:select
                                name="kelompok_penyusutan"
                                id="kelompok_penyusutan"
                            >

                                <option value="">
                                    Pilih kelompok
                                </option>

                                @foreach ($aturanPenyusutan as $kelompok => $aturan)

                                    <option
                                        value="{{ $kelompok }}"
                                        data-masa-manfaat="{{ $aturan['masa_manfaat'] }}"
                                        data-tarif="{{ $aturan['tarif_persen'] }}"
                                        @selected(
                                            (string) old(
                                                'kelompok_penyusutan',
                                                $vehicle->depreciation?->kelompok_penyusutan
                                            ) === (string) $kelompok
                                        )
                                    >

                                        Kelompok {{ $kelompok }}
                                        — {{ $aturan['masa_manfaat'] }} tahun
                                        —
                                        {{ rtrim(
                                            rtrim(
                                                number_format(
                                                    $aturan['tarif_persen'],
                                                    4,
                                                    ',',
                                                    '.'
                                                ),
                                                '0'
                                            ),
                                            ','
                                        ) }}%

                                    </option>

                                @endforeach

                            </flux:select>

                            <flux:description>
                                Pilih kelompok sesuai klasifikasi aset kendaraan.
                            </flux:description>

                            @error('kelompok_penyusutan')
                                <flux:error>
                                    {{ $message }}
                                </flux:error>
                            @enderror

                        </flux:field>

                    </div>


                    {{-- =================================================
                        MASA MANFAAT
                    ================================================== --}}

                    <div>

                        <flux:field>

                            <flux:label>
                                Masa Manfaat
                            </flux:label>

                            <flux:input
                                name="masa_manfaat"
                                id="masa_manfaat"
                                type="number"
                                min="1"
                                step="1"
                                value="{{ old(
                                    'masa_manfaat',
                                    $vehicle->depreciation?->masa_manfaat
                                ) }}"
                                placeholder="Otomatis dari kelompok"
                            />

                            <flux:description>
                                Masa manfaat dalam tahun.
                            </flux:description>

                            @error('masa_manfaat')
                                <flux:error>
                                    {{ $message }}
                                </flux:error>
                            @enderror

                        </flux:field>

                    </div>


                    {{-- =================================================
                        TARIF
                    ================================================== --}}

                    <div>

                        <flux:field>

                            <flux:label>
                                Tarif Penyusutan
                            </flux:label>

                            <div class="relative">

                                <flux:input
                                    name="tarif_penyusutan"
                                    id="tarif_penyusutan"
                                    type="number"
                                    min="0"
                                    max="100"
                                    step="0.0001"
                                    value="{{ old(
                                        'tarif_penyusutan',
                                        $vehicle->depreciation?->tarif_penyusutan
                                    ) }}"
                                    placeholder="Otomatis dari kelompok"
                                    inputmode="decimal"
                                    class="pr-10"
                                />

                                <span
                                    class="pointer-events-none absolute inset-y-0 right-3
                                           flex items-center text-sm
                                           font-semibold text-slate-400"
                                >
                                    %
                                </span>

                            </div>

                            <flux:description>
                                Tarif dalam persen per tahun.
                                Contoh: 6.25% atau 1.5625%.
                            </flux:description>

                            @error('tarif_penyusutan')
                                <flux:error>
                                    {{ $message }}
                                </flux:error>
                            @enderror

                        </flux:field>

                    </div>

                </div>


                {{-- =====================================================
                    INFO KELOMPOK
                ====================================================== --}}

                <div
                    class="mt-6 rounded-xl border border-cyan-100
                           bg-cyan-50/70 p-4
                           dark:border-cyan-900/50
                           dark:bg-cyan-950/20"
                >

                    <div class="flex items-start gap-3">

                        <flux:icon
                            name="information-circle"
                            class="mt-0.5 size-5 shrink-0
                                   text-cyan-600 dark:text-cyan-400"
                        />

                        <div class="text-sm text-cyan-900 dark:text-cyan-200">

                            <p class="font-semibold">
                                Referensi kelompok penyusutan
                            </p>

                            <div
                                class="mt-2 grid gap-2
                                       sm:grid-cols-2 lg:grid-cols-4"
                            >

                                @foreach ($aturanPenyusutan as $kelompok => $aturan)

                                    <div
                                        class="rounded-lg border border-cyan-100
                                               bg-white/70 px-3 py-2
                                               dark:border-cyan-900/50
                                               dark:bg-slate-900/40"
                                    >

                                        <div
                                            class="text-xs font-semibold
                                                   text-cyan-700
                                                   dark:text-cyan-300"
                                        >
                                            Kelompok {{ $kelompok }}
                                        </div>

                                        <div
                                            class="mt-0.5 text-xs text-slate-600
                                                   dark:text-slate-400"
                                        >

                                            {{ $aturan['masa_manfaat'] }} tahun
                                            ·
                                            {{ rtrim(
                                                rtrim(
                                                    number_format(
                                                        $aturan['tarif_persen'],
                                                        4,
                                                        ',',
                                                        '.'
                                                    ),
                                                    '0'
                                                ),
                                                ','
                                            ) }}%

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PREVIEW DATA TERSIMPAN
        ====================================================== --}}

        @if ($vehicle->depreciation)

            <div
                class="mb-6 overflow-hidden rounded-2xl
                       border border-white bg-white
                       shadow-lg shadow-slate-300/40
                       dark:border-slate-800
                       dark:bg-slate-900
                       dark:shadow-black/20"
            >

                <div
                    class="border-b border-slate-100 px-5 py-4
                           dark:border-slate-800"
                >

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-9 items-center justify-center
                                   rounded-lg bg-emerald-50
                                   dark:bg-emerald-950/30"
                        >
                            <flux:icon
                                name="chart-bar"
                                class="size-5 text-emerald-600
                                       dark:text-emerald-400"
                            />
                        </div>

                        <div>

                            <h2
                                class="font-semibold text-slate-900
                                       dark:text-white"
                            >
                                Informasi Data Tersimpan
                            </h2>

                            <p
                                class="mt-0.5 text-xs text-slate-500
                                       dark:text-slate-400"
                            >
                                Nilai saat ini sebelum perubahan disimpan.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-5 sm:p-6">

                    <div
                        class="grid gap-4
                               sm:grid-cols-2 lg:grid-cols-4"
                    >

                        {{-- NILAI PEROLEHAN --}}
                        <div
                            class="rounded-xl border border-slate-200
                                   bg-slate-50 p-4
                                   dark:border-slate-700
                                   dark:bg-slate-800/50"
                        >

                            <p
                                class="text-xs font-medium
                                       text-slate-500
                                       dark:text-slate-400"
                            >
                                Nilai Perolehan
                            </p>

                            <p
                                class="mt-2 text-base font-bold
                                       text-slate-900
                                       dark:text-white"
                            >

                                Rp
                                {{ number_format(
                                    (float) $vehicle->depreciation->nilai_perolehan,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </p>

                        </div>


                        {{-- TAHUN --}}
                        <div
                            class="rounded-xl border border-slate-200
                                   bg-slate-50 p-4
                                   dark:border-slate-700
                                   dark:bg-slate-800/50"
                        >

                            <p
                                class="text-xs font-medium
                                       text-slate-500
                                       dark:text-slate-400"
                            >
                                Tahun Perolehan
                            </p>

                            <p
                                class="mt-2 text-base font-bold
                                       text-slate-900
                                       dark:text-white"
                            >
                                {{ $vehicle->depreciation->tahun_perolehan }}
                            </p>

                        </div>


                        {{-- KELOMPOK --}}
                        <div
                            class="rounded-xl border border-cyan-100
                                   bg-cyan-50 p-4
                                   dark:border-cyan-900/50
                                   dark:bg-cyan-950/20"
                        >

                            <p
                                class="text-xs font-medium
                                       text-cyan-700
                                       dark:text-cyan-400"
                            >
                                Kelompok
                            </p>

                            <p
                                class="mt-2 text-base font-bold
                                       text-cyan-900
                                       dark:text-cyan-200"
                            >
                                Kelompok
                                {{ $vehicle->depreciation->kelompok_penyusutan }}
                            </p>

                        </div>


                        {{-- TARIF --}}
                        <div
                            class="rounded-xl border border-amber-100
                                   bg-amber-50 p-4
                                   dark:border-amber-900/50
                                   dark:bg-amber-950/20"
                        >

                            <p
                                class="text-xs font-medium
                                       text-amber-700
                                       dark:text-amber-400"
                            >
                                Tarif
                            </p>

                            <p
                                class="mt-2 text-base font-bold
                                       text-amber-900
                                       dark:text-amber-200"
                            >

                                {{ rtrim(
                                    rtrim(
                                        number_format(
                                            (float) $vehicle->depreciation->tarif_penyusutan,
                                            4,
                                            ',',
                                            '.'
                                        ),
                                        '0'
                                    ),
                                    ','
                                ) }}%

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        @endif


        {{-- =====================================================
            ACTION
        ====================================================== --}}

        <div
            class="relative z-10 mb-8 flex flex-col-reverse gap-3
                   sm:flex-row sm:items-center sm:justify-end"
        >

            <a
                href="{{ route('penyusutan.index') }}"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl border border-slate-200
                       bg-white px-5 py-3 text-sm font-semibold
                       text-slate-700 shadow-sm
                       transition hover:bg-slate-50
                       focus:outline-none focus:ring-2
                       focus:ring-slate-400 focus:ring-offset-2
                       dark:border-slate-700
                       dark:bg-slate-900
                       dark:text-slate-200
                       dark:hover:bg-slate-800
                       dark:focus:ring-offset-slate-950"
            >

                <flux:icon
                    name="x-mark"
                    class="size-4"
                />

                Batal

            </a>


            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-teal-600 px-5 py-3
                       text-sm font-semibold text-white shadow-sm
                       transition hover:bg-teal-700
                       focus:outline-none focus:ring-2
                       focus:ring-teal-500 focus:ring-offset-2
                       dark:focus:ring-offset-slate-950"
            >

                <flux:icon
                    name="check"
                    class="size-4"
                />

                Simpan Data Penyusutan

            </button>

        </div>

    </form>


    {{-- =========================================================
        AUTO GROUP RULE
    ========================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const kelompok =
                document.getElementById('kelompok_penyusutan');

            const masaManfaat =
                document.getElementById('masa_manfaat');

            const tarif =
                document.getElementById('tarif_penyusutan');


            if (!kelompok || !masaManfaat || !tarif) {
                return;
            }


            function updateAturan() {

                const selected =
                    kelompok.options[kelompok.selectedIndex];


                if (!selected || !selected.value) {
                    return;
                }


                const masa =
                    selected.dataset.masaManfaat;


                const tarifValue =
                    selected.dataset.tarif;


                if (masa) {
                    masaManfaat.value = masa;
                }


                if (tarifValue) {
                    tarif.value = tarifValue;
                }

            }


            kelompok.addEventListener(
                'change',
                updateAturan
            );


            // Jalankan otomatis ketika halaman edit pertama kali dibuka.
            updateAturan();

        });
    </script>

</x-layouts::app>