<?php

namespace App\Livewire\Collaboration\Bundle;

use App\Models\Product;
use App\Models\CollaborationProduct;
use Livewire\Component;

class Main extends Component
{
    public $collaborationId;

    public $showMyProduct = true;
    public $showPartnerProduct = true;
    public $showAddProductModal = false;

    public $searchProduct = '';
    public $filter = 'all';

    public $deleteMode = false;
    public $selectedProducts = [];

    protected $listeners = ['product-added' => 'hideAddProduct'];



    public function toggleMyProduct()
    {
        $this->showMyProduct = !$this->showMyProduct;
    }

    public function togglePartnerProduct()
    {
        $this->showPartnerProduct = !$this->showPartnerProduct;
    }



    public function showAddProduct()
    {
        $this->reset('searchProduct');
        $this->showAddProductModal = true;
    }

    public function hideAddProduct()
    {
        $this->showAddProductModal = false;
    }

    public function enableDeleteMode()
    {
        $this->deleteMode = true;
        $this->selectedProducts = [];
    }

    public function cancelDelete()
    {
        $this->deleteMode = false;
        $this->selectedProducts = [];
    }

    // Pilih produk
    public function toggleSelect($productId)
    {
        if (in_array($productId, $this->selectedProducts)) {
            $this->selectedProducts = array_diff($this->selectedProducts, [$productId]);
        } else {
            $this->selectedProducts[] = $productId;
        }
    }

    // Konfirmasi hapus
    public function confirmDelete()
    {
        if (count($this->selectedProducts)) {
            $myProductIds = Product::whereIn('id', $this->selectedProducts)
                ->whereHas('umkm', fn($q) => $q->where('user_id', auth()->id()))
                ->pluck('id')
                ->toArray();
    
            CollaborationProduct::where('collaboration_id', $this->collaborationId)
                ->whereIn('product_id', $myProductIds)
                ->delete();
        }
    
        $this->cancelDelete();
        $this->dispatch('show-toast', message: 'Produk berhasil dihapus dari kolaborasi.');

    }
    

    public function getCollaborationProductsProperty()
    {
        $query = CollaborationProduct::with(['product.umkm'])
            ->where('collaboration_id', $this->collaborationId);

        if ($this->filter === 'mine') {
            $query->whereHas('product.umkm', fn ($q) =>
                $q->where('user_id', auth()->id()));
        } elseif ($this->filter === 'partner') {
            $query->whereHas('product.umkm', fn ($q) =>
                $q->where('user_id', '!=', auth()->id()));
        }

        return $query->get();
    }

    public function render()
    {
        return view('livewire.collaboration.bundle.main', [
            'collaborationProducts' => $this->collaborationProducts,
        ]);
    }
}
