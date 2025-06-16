<?php

namespace App\Livewire\Collaboration\Bundle;

use Livewire\Component;
use App\Models\Product;
use App\Models\CollaborationProductBundle;
use App\Models\Collaboration;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $collaborationId;

    public $title;
    public $description;
    public $price;
    public $thumbnailFile;
    public $thumbnailPreview;

    public $search = '';
    public $selectedProducts = [];

    public function mount($collaborationId)
    {
        $this->collaborationId = $collaborationId;
    }

    public function updatedThumbnailFile()
    {
        $this->validate([
            'thumbnailFile' => 'image|max:2048',
        ]);

        $this->thumbnailPreview = $this->thumbnailFile->temporaryUrl();
    }

    public function getCollaborationProperty()
    {
        return Collaboration::findOrFail($this->collaborationId);
    }

    public function getMyProductsProperty()
    {
        return Product::whereHas('collaborations', function ($query) {
                $query->where('collaboration_id', $this->collaborationId);
            })
            ->whereHas('umkm', fn ($q) => $q->where('user_id', Auth::id()))
            ->when($this->search, fn ($query) =>
                $query->where('name', 'like', '%' . $this->search . '%')
            )
            ->get();
    }

    public function getPartnerProductsProperty()
    {
        return Product::whereHas('collaborations', function ($query) {
                $query->where('collaboration_id', $this->collaborationId);
            })
            ->where('umkm_id', $this->collaboration->partner_umkm_id)
            ->when($this->search, fn ($query) =>
                $query->where('name', 'like', '%' . $this->search . '%')
            )
            ->get();
    }

    public function getSelectedProductModelsProperty()
    {
        return Product::whereIn('id', $this->selectedProducts)->get();
    }

    public function toggleSelect($productId)
    {
        if (in_array($productId, $this->selectedProducts)) {
            $this->selectedProducts = array_values(array_diff($this->selectedProducts, [$productId]));
        } else {
            $this->selectedProducts[] = $productId;
        }
    }


    public function saveBundle()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'thumbnailFile' => 'required|image|max:2048',
            'selectedProducts' => 'required|array|min:1',
        ]);
    
        $thumbnailPath = $this->thumbnailFile->store('thumbnails', 'public');
    
        $bundle = \App\Models\CollaborationProductBundle::create([
            'collaboration_id' => $this->collaborationId,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'thumbnail' => $thumbnailPath,
            'product_ids' => json_encode($this->selectedProducts), 
            'status' => 'draft',
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        $bundle->products()->attach($this->selectedProducts);

    
        $this->reset(['title', 'description', 'price', 'thumbnailFile', 'thumbnailPreview', 'selectedProducts']);
        $this->resetValidation();
    
    
        $this->dispatch('show-toast', message: 'Bundling berhasil ditambahkan ');
        $this->dispatch('bundle-created');


    }

    public function render()
    {
        return view('livewire.collaboration.bundle.create', [
            'myProducts' => $this->myProducts,
            'partnerProducts' => $this->partnerProducts,
            'selectedProductModels' => $this->selectedProductModels,
        ]);
    }
}
