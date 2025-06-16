<?php

namespace App\Livewire\Collaboration\Bundle;

use Livewire\Component;
use App\Models\Product;
use App\Models\Collaboration;

use App\Models\CollaborationProduct;

class AddProduct extends Component
{
    public $search = '';
    public $selectedProductId = null;
    public $collaborationId;



    public function getMyProductsProperty()
    {
        return Product::whereHas('umkm', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->whereDoesntHave('collaborations', function ($q) {
                $q->where('collaboration_id', $this->collaborationId);
            })
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();
    }
    

public function getUsedProductIdsProperty()
{
    return \App\Models\CollaborationProduct::where('collaboration_id', $this->collaborationId)
        ->pluck('product_id')
        ->toArray();
}

    

    public function getSelectedProductProperty()
    {
        return Product::find($this->selectedProductId);
    }

    public function selectProduct($id)
    {
        $this->selectedProductId = $id;
    }

    public function addToCollaboration()
    {
        if (!$this->selectedProductId || !$this->collaborationId) return;

        CollaborationProduct::firstOrCreate([
            'collaboration_id' => $this->collaborationId,
            'product_id' => $this->selectedProductId,
        ]);

        $this->selectedProductId = null;
        $this->search = '';

        $this->dispatch('product-added');
        $this->dispatch('show-toast', message: 'Produk berhasil ditambahkan ke kolaborasi.');

    }

    public function render()
    {
        return view('livewire.collaboration.bundle.add-product', [
            'myProducts' => $this->myProducts,
            'selectedProduct' => $this->selectedProduct,
            'usedProductIds' => $this->usedProductIds,
        ]);
    }
    
}
