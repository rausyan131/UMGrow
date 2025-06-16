<?php

namespace App\Livewire\Umkm;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Umkm;
use App\Models\Category;

class UmkmList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $searchInput = '';
    public $category = '';
    public $selectedUmkm = null;

    protected $queryString = ['search', 'category'];

    public function mount()
    {
        $this->searchInput = $this->search;
    }

    public function searchUmkm()
    {
        $this->search = $this->searchInput;
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function selectUmkm($id)
    {
        $this->selectedUmkm = Umkm::with(['user', 'categories'])->find($id);
    }

    public function render()
    {
        $categories = Category::pluck('category_name', 'id');

        $umkms = Umkm::with(['user', 'categories'])
            ->when($this->search, function ($query) {
                $query->where('umkm_name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->category, function ($query) {
                $query->whereHas('categories', function ($q) {
                    $q->where('categories.id', $this->category);
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.umkm.umkm-list', [
            'umkms' => $umkms,
            'categories' => $categories,
            'selectedUmkm' => $this->selectedUmkm,
        ]);
    }
}
