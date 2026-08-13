<?php

namespace App\Livewire\Vehicle;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public string $filterKategori = '';

    public string $filterStatus = '';

    protected $queryString = ['search', 'filterKategori', 'filterStatus'];

    public function render()
    {
        $vehicles = Vehicle::query()
            ->when($this->search, fn ($q) => $q->where('nomor_polisi', 'like', '%'.$this->search.'%')
                ->orWhere('merek', 'like', '%'.$this->search.'%')
                ->orWhere('nama_pemakai', 'like', '%'.$this->search.'%'))
            ->when($this->filterKategori, fn ($q) => $q->where('kategori', $this->filterKategori))
            ->when($this->filterStatus, fn ($q) => $q->where('status', $this->filterStatus))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $kategoriList = Vehicle::select('kategori')->distinct()->pluck('kategori');

        return view('livewire.vehicle.index', [
            'vehicles' => $vehicles,
            'kategoriList' => $kategoriList,
        ]);
    }
}
