<?php
namespace App\Livewire\Collaboration\Bundle;

use Livewire\Component;
use App\Models\CollaborationProductBundle;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class BundleList extends Component
{
    public $collaborationId;
    public $search = '';
    public $filter = 'all';
    public $showCreateModal = false;
    public $deleteMode = false;
    public $selectedBundles = [];
    public $searchInput = '';

    public $showDetailModal = false;
    public $selectedBundleId = null;

    public function showDetail($id)
    {
        $this->selectedBundleId = $id;
        $this->showDetailModal = true;
    }
    
    public function hideDetail()
    {
        $this->showDetailModal = false;
        $this->selectedBundleId = null;
    }
    
    
    
    public function searchBundles()
    {
        $this->search = $this->searchInput;
    }
    

    protected $listeners = ['bundle-created' => '$refresh'];


    public function toggleModal()
    {
        $this->showCreateModal = !$this->showCreateModal;
    }

    public function enableDeleteMode()
    {
        $this->deleteMode = true;
    }

    public function cancelDelete()
    {
        $this->deleteMode = false;
        $this->selectedBundles = [];
    }

    public function toggleSelect($bundleId)
    {
        if (in_array($bundleId, $this->selectedBundles)) {
            $this->selectedBundles = array_diff($this->selectedBundles, [$bundleId]);
        } else {
            $this->selectedBundles[] = $bundleId;
        }
    }

    public function confirmDelete()
    {
        CollaborationProductBundle::whereIn('id', $this->selectedBundles)->delete();
        $this->cancelDelete();
        $this->dispatch('show-toast', message: 'Bundling terpilih berhasil dihapus.');
    }

    public function getBundlesProperty()
    {
        return CollaborationProductBundle::where('collaboration_id', $this->collaborationId)
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->filter !== 'all', fn($q) => $q->where('status', $this->filter))
            ->latest()
            ->get();
    }
    


    public function render()
    {
        return view('livewire.collaboration.bundle.bundle-list', [
            'bundles' => $this->bundles,
        ]);
    }
}
