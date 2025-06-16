<?php

namespace App\Livewire\Collaboration;

use App\Models\Collaboration;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $targetUmkm;
    public $message;
    public $ideas;
    public $selectedProducts = []; 
    public $selectedProductDetails = []; 
    public $search = '';
    public $searchInput = '';
    public $searchKeyword = '';
    
    protected $listeners = ['addToMessage', 'addToIdeas'];


    public function mount()
    {
        $this->updatedSelectedProducts(); 
    }

    public function updatedSelectedProducts()
    {
        $this->selectedProductDetails = Product::whereIn('id', $this->selectedProducts)
            ->get()
            ->map(fn ($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'image' => $p->image,
            ])
            ->toArray();
    }

    public function removeProduct($id)
    {
        $this->selectedProducts = array_filter($this->selectedProducts, fn ($pid) => $pid != $id);
        $this->updatedSelectedProducts(); 
    }

    public function searchProducts()
    {
        $this->searchKeyword = $this->searchInput;
    }

    public function submit()
    {
        $this->validate([
            'message' => 'required|string|min:10',
            'selectedProducts' => 'required|array|min:1',
        ]);

        $userUmkm = Auth::user()->umkm;

        $collab = Collaboration::create([
            'initiator_umkm_id' => $userUmkm->id,
            'partner_umkm_id' => $this->targetUmkm,
            'message' => $this->message,
            'ideas' => $this->ideas,
            'collaboration_type' => 'produk',
        ]);

        $collab->products()->attach($this->selectedProducts);

        $this->reset(['message', 'ideas', 'selectedProducts', 'selectedProductDetails']);
        session()->flash('success', 'Pengajuan kolaborasi Anda telah berhasil dikirim. Mohon menunggu konfirmasi selanjutnya.');

        $this->dispatch('refresh-page');



    }

    



    public function render()
    {
        $userUmkm = Auth::user()->umkm;

        $products = collect();

        if ($this->searchKeyword) {
            $products = Product::where('umkm_id', $userUmkm->id)
                ->where('name', 'like', '%' . $this->searchKeyword . '%')
                ->get();
        }

        return view('livewire.collaboration.create', [
            'products' => $products,
            'selectedProduct' => $this->selectedProductDetails,
        ]);
    }
}
