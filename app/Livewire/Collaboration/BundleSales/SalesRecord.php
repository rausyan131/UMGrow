<?php

namespace App\Livewire\Collaboration\BundleSales;

use Livewire\Component;
use App\Models\BundleSale;
use App\Models\Product;
use App\Models\CollaborationProductBundle;

class SalesRecord extends Component
{
    public $collaborationId;

    public $showModal = false;
    public $showDetailModal = false;

    public $bundle_id, $quantity, $sold_at;

    public $selectedSaleId;

    public $search, $searchDate;



    protected $listeners = [
        'close-detail' => 'closeSaleDetail',
    ];

  

    public function render()
    {
        $sales = BundleSale::with('bundle')
            ->when($this->search, fn ($q) =>
                $q->whereHas('bundle', fn ($q) =>
                    $q->where('title', 'like', '%' . $this->search . '%')
                )
            )
            ->when($this->searchDate, fn ($q) =>
                $q->whereDate('sold_at', $this->searchDate)
            )
            ->whereHas('bundle', fn ($q) =>
                $q->where('collaboration_id', $this->collaborationId)
            )
            ->latest()
            ->get();

        $bundles = CollaborationProductBundle::where('collaboration_id', $this->collaborationId)
            ->with('products') 
            ->get();

        return view('livewire.collaboration.bundle-sales.sales-record', compact('sales', 'bundles'));
    }

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
        $this->reset(['bundle_id', 'quantity', 'sold_at']);
    }

    public function searchNow() {}

    public function openSaleDetail($id)
    {
        $this->selectedSaleId = $id;
        $this->showDetailModal = true;
    }

    public function closeSaleDetail()
    {
        $this->showDetailModal = false;
    }

    public function save()
    {
        $this->validate([
            'bundle_id' => 'required|exists:collaboration_product_bundles,id',
            'quantity' => 'required|integer|min:1',
            'sold_at' => 'required|date',
        ]);
    
        $bundle = CollaborationProductBundle::with('products')->findOrFail($this->bundle_id);
    
        foreach ($bundle->products as $product) {
            if ($product->stock < $this->quantity) {
                $this->addError('quantity', 'Stok produk "' . $product->name . '" tidak cukup. Tersisa: ' . $product->stock);
                return;
            }
        }
    
        $totalPrice = $bundle->price * $this->quantity;
    
        $sale = BundleSale::create([
            'bundle_id' => $this->bundle_id,
            'quantity' => $this->quantity,
            'sold_at' => $this->sold_at,
            'total_price' => $totalPrice,
            'created_by' => auth()->id(),
        ]);
    
        foreach ($bundle->products as $product) {
            $product->stock -= $this->quantity;
            $product->save();
        }
    
        $this->toggleModal();
        $this->dispatch('show-toast', message: 'Catatan penjualan berhasil ditambahkan dan stok dikurangi!');
    }
    
 
}
