<x-layouts::app :title="__('Tambah Kendaraan')">

    {{-- =========================================================
        AMBIENT BACKGROUND GLOW
    ========================================================== --}}
    <div class="fixed inset-0 z-[-1] bg-gradient-to-br from-[#bae6fd] via-[#e0f2fe] to-[#a5f3fc] dark:from-[#020617] dark:via-[#0f172a] dark:to-[#083344] pointer-events-none overflow-hidden">
        <div class="absolute -top-[20%] -left-[10%] w-[70vw] h-[70vw] max-w-[800px] max-h-[800px] rounded-full bg-cyan-500/20 blur-[120px] dark:bg-cyan-900/30"></div>
        <div class="absolute -bottom-[20%] -right-[10%] w-[60vw] h-[60vw] max-w-[600px] max-h-[600px] rounded-full bg-sky-500/20 blur-[120px] dark:bg-sky-900/30"></div>
    </div>

    <div class="relative mx-auto flex h-full w-full max-w-5xl flex-1 flex-col gap-6 pb-12 z-0">

        {{-- ==========================================
            HEADER HALAMAN
        =========================================== --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#111827] to-[#0b334d] px-6 py-8 text-white shadow-xl sm:px-10 border border-white/5">
            <div class="pointer-events-none absolute -right-12 -top-16 size-48 rounded-full border-[18px] border-white/5"></div>
            <div class="pointer-events-none absolute -bottom-24 right-24 size-56 rounded-full border-[22px] border-white/5"></div>

            <div class="relative z-10">
                <div class="mb-2 flex items-center gap-2 text-cyan-400">
                    <flux:icon name="plus-circle" class="size-4" />
                    <span class="text-xs font-bold uppercase tracking-[0.2em]">Armada</span>
                </div>

                <flux:heading size="xl" class="text-white font-bold tracking-tight">
                    Tambah Kendaraan
                </flux:heading>

                <flux:text class="mt-2 text-slate-300 max-w-xl text-sm leading-relaxed">
                    Lengkapi informasi kendaraan baru ke dalam sistem dengan jelas dan akurat.
                </flux:text>
            </div>
        </div>

        {{-- ==========================================
            FORMULIR UTAMA
        =========================================== --}}
        <form action="{{ route('vehicles.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- 1. Spesifikasi Kendaraan --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">

                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/80 px-6 py-5 dark:border-slate-800 dark:bg-slate-800/50">
                    <flux:icon name="document-text" class="size-5 text-cyan-600 dark:text-cyan-400" />

                    <flux:heading size="sm" class="font-bold text-slate-800 dark:text-slate-100">
                        Spesifikasi Kendaraan
                    </flux:heading>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2 lg:grid-cols-3">

                    <flux:input
                        label="Merek *"
                        name="merek"
                        :value="old('merek')"
                        placeholder="Contoh: Toyota, Honda"
                        required
                    />

                    <flux:input
                        label="Tipe *"
                        name="tipe"
                        :value="old('tipe')"
                        placeholder="Contoh: Avanza, CR-V"
                        required
                    />

                    <flux:input
                        label="Jenis *"
                        name="jenis"
                        :value="old('jenis')"
                        placeholder="Contoh: Minibus, Sedan"
                        required
                    />

                    <flux:select label="Bahan Bakar" name="bahan_bakar">
                        <flux:select.option value="">
                            Pilih Bahan Bakar
                        </flux:select.option>

                        <flux:select.option
                            value="Pertalite"
                            :selected="old('bahan_bakar') == 'Pertalite'"
                        >
                            Pertalite
                        </flux:select.option>

                        <flux:select.option
                            value="Pertamax"
                            :selected="old('bahan_bakar') == 'Pertamax'"
                        >
                            Pertamax
                        </flux:select.option>

                        <flux:select.option
                            value="Pertamax Turbo"
                            :selected="old('bahan_bakar') == 'Pertamax Turbo'"
                        >
                            Pertamax Turbo
                        </flux:select.option>

                        <flux:select.option
                            value="Solar"
                            :selected="old('bahan_bakar') == 'Solar'"
                        >
                            Solar
                        </flux:select.option>

                        <flux:select.option
                            value="Diesel"
                            :selected="old('bahan_bakar') == 'Diesel'"
                        >
                            Diesel
                        </flux:select.option>

                        <flux:select.option
                            value="Listrik"
                            :selected="old('bahan_bakar') == 'Listrik'"
                        >
                            Listrik
                        </flux:select.option>
                    </flux:select>

                    <flux:input
                        label="Nomor Polisi *"
                        name="nomor_polisi"
                        :value="old('nomor_polisi')"
                        placeholder="Contoh: B 1234 ABC"
                        required
                    />

                    <flux:input
                        label="Nomor Chasis *"
                        name="nomor_chasis"
                        :value="old('nomor_chasis')"
                        placeholder="Nomor Chasis"
                        required
                    />

                    <flux:input
                        label="Nomor Mesin *"
                        name="nomor_mesin"
                        :value="old('nomor_mesin')"
                        placeholder="Nomor Mesin"
                        required
                    />

                    <flux:input
                        label="Tahun Pemakaian *"
                        name="tahun_pemakaian"
                        :value="old('tahun_pemakaian')"
                        type="number"
                        min="1990"
                        max="{{ date('Y') }}"
                        placeholder="{{ date('Y') }}"
                        required
                    />

                </div>
            </div>

            {{-- 2. Masa Berlaku --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">

                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/80 px-6 py-5 dark:border-slate-800 dark:bg-slate-800/50">
                    <flux:icon name="calendar-days" class="size-5 text-cyan-600 dark:text-cyan-400" />

                    <flux:heading size="sm" class="font-bold text-slate-800 dark:text-slate-100">
                        Masa Berlaku Dokumen
                    </flux:heading>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <flux:input
                        label="Masa Berlaku Pajak *"
                        name="masa_berlaku_pajak"
                        :value="old('masa_berlaku_pajak')"
                        type="date"
                        required
                    />

                    <flux:input
                        label="Masa Berlaku STNK *"
                        name="masa_berlaku_stnk"
                        :value="old('masa_berlaku_stnk')"
                        type="date"
                        required
                    />

                </div>
            </div>

            {{-- 3. Pemakai --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">

                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/80 px-6 py-5 dark:border-slate-800 dark:bg-slate-800/50">
                    <flux:icon name="user" class="size-5 text-cyan-600 dark:text-cyan-400" />

                    <flux:heading size="sm" class="font-bold text-slate-800 dark:text-slate-100">
                        Pemakai Operasional
                    </flux:heading>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <flux:input
                        label="Nama Pemakai *"
                        name="nama_pemakai"
                        :value="old('nama_pemakai')"
                        placeholder="Nama lengkap pemakai"
                        required
                    />

                    <flux:input
                        label="Jabatan *"
                        name="jabatan_pemakai"
                        :value="old('jabatan_pemakai')"
                        placeholder="Contoh: Sopir, Manager"
                        required
                    />

                </div>
            </div>

            {{-- 4. Kategori --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">

                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/80 px-6 py-5 dark:border-slate-800 dark:bg-slate-800/50">
                    <flux:icon name="tag" class="size-5 text-cyan-600 dark:text-cyan-400" />

                    <flux:heading size="sm" class="font-bold text-slate-800 dark:text-slate-100">
                        Kategori Armada
                    </flux:heading>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <flux:select label="Kategori Utama *" name="kategori" required>
                        <flux:select.option value="">
                            Pilih Kategori
                        </flux:select.option>

                        <flux:select.option
                            value="roda_2"
                            :selected="old('kategori') == 'roda_2'"
                        >
                            Roda 2
                        </flux:select.option>

                        <flux:select.option
                            value="roda_4"
                            :selected="old('kategori') == 'roda_4'"
                        >
                            Roda 4
                        </flux:select.option>
                        <flux:select.option
    value="kendaraan_laut"
    :selected="old('kategori') == 'kendaraan_laut'"
>
    Kendaraan Laut
</flux:select.option>
                    </flux:select>

                    <flux:input
                        label="Sub Kategori"
                        name="sub_kategori"
                        :value="old('sub_kategori')"
                        placeholder="Contoh: Ambulans, Mobil Patroli"
                    />

                </div>
            </div>

            {{-- 5. Biaya --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">

                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/80 px-6 py-5 dark:border-slate-800 dark:bg-slate-800/50">
                    <flux:icon name="banknotes" class="size-5 text-cyan-600 dark:text-cyan-400" />

                    <flux:heading size="sm" class="font-bold text-slate-800 dark:text-slate-100">
                        Rincian Biaya
                    </flux:heading>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-3">

                    {{-- Formatter Rupiah Global --}}
                    <flux:input
                        label="Anggaran Biaya (Rp)"
                        name="anggaran_biaya"
                        :value="old('anggaran_biaya')"
                        type="text"
                        inputmode="numeric"
                        data-rupiah
                        placeholder="0"
                    />

                    {{-- Formatter Rupiah Global --}}
                    <flux:input
                        label="Biaya Plat/STNK (Rp)"
                        name="biaya_plat_stnk"
                        :value="old('biaya_plat_stnk')"
                        type="text"
                        inputmode="numeric"
                        data-rupiah
                        placeholder="0"
                    />

                    <flux:select label="Sumber Kendaraan *" name="sumber_kendaraan" required>
                        <flux:select.option value="">
                            Pilih Sumber
                        </flux:select.option>

                        <flux:select.option
                            value="APBD"
                            :selected="old('sumber_kendaraan') == 'APBD'"
                        >
                            APBD
                        </flux:select.option>

                        <flux:select.option
                            value="APBN"
                            :selected="old('sumber_kendaraan') == 'APBN'"
                        >
                            APBN
                        </flux:select.option>
                    </flux:select>

                </div>
            </div>

            {{-- 6. Keterangan --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">

                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/80 px-6 py-5 dark:border-slate-800 dark:bg-slate-800/50">
                    <flux:icon name="clipboard-document-list" class="size-5 text-cyan-600 dark:text-cyan-400" />

                    <flux:heading size="sm" class="font-bold text-slate-800 dark:text-slate-100">
                        Keterangan Tambahan
                    </flux:heading>
                </div>

                <div class="space-y-5 p-6">

                    <flux:textarea
                        label="Keterangan Pajak"
                        name="keterangan_pajak"
                        :value="old('keterangan_pajak')"
                        placeholder="Tambahkan catatan khusus mengenai pajak kendaraan..."
                        rows="2"
                    />

                    <flux:textarea
                        label="Keterangan Kendaraan"
                        name="keterangan_kendaraan"
                        :value="old('keterangan_kendaraan')"
                        placeholder="Tambahkan catatan mengenai kondisi fisik atau riwayat kendaraan..."
                        rows="2"
                    />

                </div>
            </div>

            {{-- 7. Status & Submit --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-200/50 border border-slate-100 dark:bg-slate-900 dark:border-slate-800 dark:shadow-black/20">

                <div class="flex items-center gap-3 border-b border-slate-100 bg-slate-50/80 px-6 py-5 dark:border-slate-800 dark:bg-slate-800/50">
                    <flux:icon name="check-badge" class="size-5 text-cyan-600 dark:text-cyan-400" />

                    <flux:heading size="sm" class="font-bold text-slate-800 dark:text-slate-100">
                        Status Operasional
                    </flux:heading>
                </div>

                <div class="p-6 flex flex-col md:flex-row md:items-end gap-6 justify-between">

                    {{-- Dropdown Status --}}
                    <div class="w-full md:max-w-xs relative">

                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Pilih Status *
                        </label>

                        <div class="relative">

                            <select
                                name="status"
                                required
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
                            >
                                <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="non_aktif" {{ old('status') == 'non_aktif' ? 'selected' : '' }}>
                                    Non Aktif
                                </option>

                                <option value="perbaikan" {{ old('status') == 'perbaikan' ? 'selected' : '' }}>
                                    Perbaikan
                                </option>

                                <option value="dijual" {{ old('status') == 'dijual' ? 'selected' : '' }}>
                                    Dijual
                                </option>
                            </select>

                            <flux:icon
                                name="chevron-down"
                                class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-slate-400"
                            />

                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-wrap items-center gap-3 mt-4 md:mt-0 pt-1">

                        <flux:button
                            :href="route('vehicles.index')"
                            class="!bg-white hover:!bg-slate-50 !text-slate-700 border border-slate-200 shadow-sm px-6 dark:!bg-slate-800 dark:!text-slate-200 dark:border-slate-700 dark:hover:!bg-slate-700"
                        >
                            Batal
                        </flux:button>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-cyan-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-cyan-700 transition-all focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:bg-cyan-700 dark:hover:bg-cyan-600"
                        >
                            <flux:icon name="folder-arrow-down" class="size-4" />
                            Simpan Kendaraan
                        </button>

                    </div>

                </div>
            </div>

        </form>
    </div>
</x-layouts::app>