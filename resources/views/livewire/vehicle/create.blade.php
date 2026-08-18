<div>
    <div class="mb-6">
        <flux:heading size="lg">{{ $vehicle ? 'Edit Kendaraan' : 'Tambah Kendaraan' }}</flux:heading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Spesifikasi Kendaraan</flux:heading>
            </div>
            <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-3">
                <flux:input label="Merek" wire:model="merek" placeholder="Contoh: Toyota, Honda" required />
                <flux:input label="Tipe" wire:model="tipe" placeholder="Contoh: Avanza, CR-V" required />
                <flux:input label="Jenis" wire:model="jenis" placeholder="Contoh: Minibus, Sedan" required />
                <flux:input label="Nomor Polisi" wire:model="nomor_polisi" placeholder="Contoh: B 1234 ABC" required />
                <flux:input label="Nomor Chasis" wire:model="nomor_chasis" placeholder="Nomor Chasis" required />
                <flux:input label="Nomor Mesin" wire:model="nomor_mesin" placeholder="Nomor Mesin" required />
                <flux:input label="Tahun Pemakaian" wire:model="tahun_pemakaian" type="number" min="1990" max="{{ date('Y') }}" placeholder="{{ date('Y') }}" required />
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Masa Berlaku</flux:heading>
            </div>
            <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                <flux:input label="Masa Berlaku Pajak" wire:model="masa_berlaku_pajak" type="date" required />
                <flux:input label="Masa Berlaku STNK" wire:model="masa_berlaku_stnk" type="date" required />
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Pemakai</flux:heading>
            </div>
            <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                <flux:input label="Nama Pemakai" wire:model="nama_pemakai" placeholder="Nama lengkap" required />
                <flux:input label="Jabatan" wire:model="jabatan_pemakai" placeholder="Contoh: Sopir, Manager" required />
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Kategori</flux:heading>
            </div>
            <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                <flux:input label="Kategori" wire:model="kategori" placeholder="Contoh: Roda 4, Roda 2" required />
                <flux:input label="Sub Kategori (opsional)" wire:model="sub_kategori" placeholder="Contoh: Ambulans, Patroli" />
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Biaya</flux:heading>
            </div>
            <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-3">
                <flux:input label="Anggaran Biaya" wire:model="anggaran_biaya" type="number" step="1000" min="0" placeholder="0" />
                <flux:input label="Biaya Plat/STNK" wire:model="biaya_plat_stnk" type="number" step="1000" min="0" placeholder="0" />
                <flux:input label="Sumber Kendaraan" wire:model="sumber_kendaraan" placeholder="Contoh: APD, BLUD" required />
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Keterangan</flux:heading>
            </div>
            <div class="space-y-4 p-4">
                <flux:textarea label="Keterangan Pajak" wire:model="keterangan_pajak" placeholder="Catatan tentang pajak..." rows="2" />
                <flux:textarea label="Keterangan Kendaraan" wire:model="keterangan_kendaraan" placeholder="Catatan kondisi kendaraan..." rows="2" />
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                <flux:heading size="sm">Status</flux:heading>
            </div>
            <div class="p-4">
                <flux:select wire:model="status" required>
                    <flux:select.option value="aktif">Aktif</flux:select.option>
                    <flux:select.option value="non_aktif">Non Aktif</flux:select.option>
                    <flux:select.option value="perbaikan">Perbaikan</flux:select.option>
                    <flux:select.option value="dijual">Dijual</flux:select.option>
                </flux:select>
            </div>
        </div>

        <div class="flex gap-2">
            <flux:button type="submit" variant="primary">
                {{ $vehicle ? 'Update' : 'Simpan' }}
            </flux:button>
            <flux:button :href="route('vehicles.index')" wire:navigate variant="ghost">
                Batal
            </flux:button>
        </div>
    </form>
</div>
