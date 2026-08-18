<x-layouts::app :title="__('Edit Kendaraan')">
    <div class="mx-auto flex h-full w-full max-w-5xl flex-1 flex-col gap-5 pb-8">
        <div class="rounded-3xl bg-gradient-to-br from-cyan-600 via-sky-700 to-indigo-800 px-6 py-6 text-white shadow-lg shadow-sky-900/15 sm:px-8">
            <div class="mb-1 flex items-center gap-2 text-cyan-100"><flux:icon name="pencil" class="size-4" /><span class="text-xs font-semibold uppercase tracking-[0.18em]">Armada</span></div>
            <flux:heading size="lg" class="text-white">Edit Kendaraan</flux:heading>
            <flux:text class="mt-1 text-sky-100">Perbarui informasi kendaraan agar selalu akurat.</flux:text>
        </div>

        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Spesifikasi Kendaraan</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-3">
                    <flux:input label="Merek *" name="merek" :value="old('merek', $vehicle->merek)" required />
                    <flux:input label="Tipe *" name="tipe" :value="old('tipe', $vehicle->tipe)" required />
                    <flux:input label="Jenis *" name="jenis" :value="old('jenis', $vehicle->jenis)" required />
                    <flux:input label="Nomor Polisi *" name="nomor_polisi" :value="old('nomor_polisi', $vehicle->nomor_polisi)" required />
                    <flux:input label="Nomor Chasis *" name="nomor_chasis" :value="old('nomor_chasis', $vehicle->nomor_chasis)" required />
                    <flux:input label="Nomor Mesin *" name="nomor_mesin" :value="old('nomor_mesin', $vehicle->nomor_mesin)" required />
                    <flux:input label="Tahun Pemakaian *" name="tahun_pemakaian" :value="old('tahun_pemakaian', $vehicle->tahun_pemakaian)" type="number" min="1990" max="{{ date('Y') }}" required />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Masa Berlaku</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                    <flux:input label="Masa Berlaku Pajak *" name="masa_berlaku_pajak" :value="old('masa_berlaku_pajak', $vehicle->masa_berlaku_pajak->format('Y-m-d'))" type="date" required />
                    <flux:input label="Masa Berlaku STNK *" name="masa_berlaku_stnk" :value="old('masa_berlaku_stnk', $vehicle->masa_berlaku_stnk->format('Y-m-d'))" type="date" required />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Pemakai</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                    <flux:input label="Nama Pemakai *" name="nama_pemakai" :value="old('nama_pemakai', $vehicle->nama_pemakai)" required />
                    <flux:input label="Jabatan *" name="jabatan_pemakai" :value="old('jabatan_pemakai', $vehicle->jabatan_pemakai)" required />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Kategori</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                    <flux:select label="Kategori *" name="kategori" required>
                        <flux:select.option value="">Pilih Kategori</flux:select.option>
                        <flux:select.option value="roda_2" :selected="$vehicle->kategori == 'roda_2'">Roda 2</flux:select.option>
                        <flux:select.option value="roda_4" :selected="$vehicle->kategori == 'roda_4'">Roda 4</flux:select.option>
                    </flux:select>
                    <flux:input label="Sub Kategori" name="sub_kategori" :value="old('sub_kategori', $vehicle->sub_kategori)" />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Biaya</flux:heading>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-3">
                    <flux:input label="Anggaran Biaya" name="anggaran_biaya" :value="old('anggaran_biaya', $vehicle->anggaran_biaya)" type="number" step="1000" min="0" />
                    <flux:input label="Biaya Plat/STNK" name="biaya_plat_stnk" :value="old('biaya_plat_stnk', $vehicle->biaya_plat_stnk)" type="number" step="1000" min="0" />
                    <flux:input label="Sumber Kendaraan *" name="sumber_kendaraan" :value="old('sumber_kendaraan', $vehicle->sumber_kendaraan)" required />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Keterangan</flux:heading>
                </div>
                <div class="space-y-4 p-4">
                    <flux:textarea label="Keterangan Pajak" name="keterangan_pajak" :value="old('keterangan_pajak', $vehicle->keterangan_pajak)" rows="2" />
                    <flux:textarea label="Keterangan Kendaraan" name="keterangan_kendaraan" :value="old('keterangan_kendaraan', $vehicle->keterangan_kendaraan)" rows="2" />
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sky-100 dark:bg-slate-900 dark:ring-sky-900/60">
                <div class="border-b border-sky-100 bg-gradient-to-r from-cyan-50 to-sky-50 px-5 py-4 dark:border-sky-900/50 dark:from-cyan-950/30 dark:to-sky-950/30">
                    <flux:heading size="sm" class="text-sky-900 dark:text-sky-100">Status</flux:heading>
                </div>
                <div class="p-4">
                    <select name="status" required class="w-full rounded-xl border border-sky-200 bg-white px-3 py-2 text-sm text-slate-700 dark:border-sky-900 dark:bg-slate-900 dark:text-slate-200">
                        <option value="aktif" {{ $vehicle->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="non_aktif" {{ $vehicle->status == 'non_aktif' ? 'selected' : '' }}>Non Aktif</option>
                        <option value="perbaikan" {{ $vehicle->status == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                        <option value="dijual" {{ $vehicle->status == 'dijual' ? 'selected' : '' }}>Dijual</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary">Update</flux:button>
                <flux:button :href="route('vehicles.index')" variant="ghost">Batal</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
