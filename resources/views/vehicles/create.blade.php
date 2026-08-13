<x-layouts::app :title="__('Tambah Kendaraan')">
    <div class="mx-auto flex h-full w-full max-w-5xl flex-1 flex-col gap-5 pb-8">
        <div class="rounded-3xl bg-gradient-to-br from-cyan-600 via-sky-700 to-indigo-800 px-6 py-6 text-white shadow-lg shadow-sky-900/15 sm:px-8">
            <div class="mb-1 flex items-center gap-2 text-cyan-100"><flux:icon name="plus" class="size-4" /><span class="text-xs font-semibold uppercase tracking-[0.18em]">Armada</span></div>
            <flux:heading size="lg" class="text-white">Tambah Kendaraan</flux:heading>
            <flux:text class="mt-1 text-sky-100">Lengkapi informasi kendaraan dengan jelas dan akurat.</flux:text>
        </div>

        <form action="{{ route('vehicles.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Spesifikasi Kendaraan</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-3">
                    <flux:input label="Merek *" name="merek" :value="old('merek')" placeholder="Contoh: Toyota, Honda" required />
                    <flux:input label="Tipe *" name="tipe" :value="old('tipe')" placeholder="Contoh: Avanza, CR-V" required />
                    <flux:input label="Jenis *" name="jenis" :value="old('jenis')" placeholder="Contoh: Minibus, Sedan" required />
                    <flux:input label="Nomor Polisi *" name="nomor_polisi" :value="old('nomor_polisi')" placeholder="Contoh: B 1234 ABC" required />
                    <flux:input label="Nomor Chasis *" name="nomor_chasis" :value="old('nomor_chasis')" placeholder="Nomor Chasis" required />
                    <flux:input label="Nomor Mesin *" name="nomor_mesin" :value="old('nomor_mesin')" placeholder="Nomor Mesin" required />
                    <flux:input label="Tahun Pemakaian *" name="tahun_pemakaian" :value="old('tahun_pemakaian')" type="number" min="1990" max="{{ date('Y') }}" placeholder="{{ date('Y') }}" required />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Masa Berlaku</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                    <flux:input label="Masa Berlaku Pajak *" name="masa_berlaku_pajak" :value="old('masa_berlaku_pajak')" type="date" required />
                    <flux:input label="Masa Berlaku STNK *" name="masa_berlaku_stnk" :value="old('masa_berlaku_stnk')" type="date" required />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Pemakai</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                    <flux:input label="Nama Pemakai *" name="nama_pemakai" :value="old('nama_pemakai')" placeholder="Nama lengkap" required />
                    <flux:input label="Jabatan *" name="jabatan_pemakai" :value="old('jabatan_pemakai')" placeholder="Contoh: Sopir, Manager" required />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Kategori</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                    <flux:input label="Kategori *" name="kategori" :value="old('kategori')" placeholder="Contoh: Roda 4, Roda 2" required />
                    <flux:input label="Sub Kategori" name="sub_kategori" :value="old('sub_kategori')" placeholder="Contoh: Ambulans, Patroli" />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Biaya</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-3">
                    <flux:input label="Anggaran Biaya" name="anggaran_biaya" :value="old('anggaran_biaya')" type="number" step="1000" min="0" placeholder="0" />
                    <flux:input label="Biaya Plat/STNK" name="biaya_plat_stnk" :value="old('biaya_plat_stnk')" type="number" step="1000" min="0" placeholder="0" />
                    <flux:input label="Sumber Dana *" name="sumber_dana" :value="old('sumber_dana')" placeholder="Contoh: APD, BLUD" required />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Keterangan</flux:heading>
                </div>
                <div class="space-y-4 p-4">
                    <flux:textarea label="Keterangan Pajak" name="keterangan_pajak" :value="old('keterangan_pajak')" placeholder="Catatan tentang pajak..." rows="2" />
                    <flux:textarea label="Keterangan Kendaraan" name="keterangan_kendaraan" :value="old('keterangan_kendaraan')" placeholder="Catatan kondisi kendaraan..." rows="2" />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Status</flux:heading>
                </div>
                <div class="p-4">
                    <select name="status" required class="w-full rounded-xl border border-sky-200 bg-white px-3 py-2 text-sm text-slate-700 dark:border-sky-900 dark:bg-slate-900 dark:text-slate-200">
                        <option value="aktif">Aktif</option>
                        <option value="non_aktif">Non Aktif</option>
                        <option value="perbaikan">Perbaikan</option>
                        <option value="dijual">Dijual</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary">Simpan</flux:button>
                <flux:button :href="route('vehicles.index')" variant="ghost">Batal</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
