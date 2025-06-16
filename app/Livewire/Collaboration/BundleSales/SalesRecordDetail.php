<?php

namespace App\Livewire\Collaboration\BundleSales;

use Livewire\Component;
use App\Models\BundleSale;

class SalesRecordDetail extends Component
{
    public $saleId;
    public $sale;

    public $sold_at;
    public $quantity;

    public $confirmingDelete = false;


    public function mount($saleId)
    {
        $this->saleId = $saleId;
        $this->sale = BundleSale::with(['bundle', 'bundle.products'])->findOrFail($saleId);

   
        $this->sold_at = $this->sale->sold_at->format('Y-m-d');
        $this->quantity = $this->sale->quantity;
    }

    public function saveEdit()
    {
        $this->validate([
            'sold_at' => 'required|date',
            'quantity' => 'required|integer|min:1',
        ]);

   
        $selisih = $this->quantity - $this->sale->quantity;

        foreach ($this->sale->bundle->products as $product) {
            $product->stock -= $selisih;
            $product->save();
        }

        
        $this->sale->update([
            'sold_at' => $this->sold_at,
            'quantity' => $this->quantity,
            'total_price' => $this->sale->bundle->price * $this->quantity,
            'updated_by' => auth()->id(),
        ]);

        $this->dispatch('show-toast', message: 'Perubahan berhasil disimpan!');
        $this->dispatch('close-detail');
    }

    public function deleteSale()
    {
        foreach ($this->sale->bundle->products as $product) {
            $product->stock += $this->sale->quantity;
            $product->save();
        }
    
        $this->sale->delete();
    
        $this->dispatch('show-toast', message: 'Penjualan berhasil dihapus');
        $this->dispatch('close-detail');
        $this->dispatch('refresh-sales'); 
    }
    
    

    public function closeModal()
    {
        $this->dispatch('close-detail');
    }

    public function render()
    {
        return view('livewire.collaboration.bundle-sales.sales-record-detail');
    }
}
