<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    use WithFileUploads;

    public Product $product;
    public bool $editMode = false;

    public string $name;
    public ?string $description = '';
    public int $price;
    public int $stock;
    public string $productImage;
    public $createdAt;
    public $updatedAt;
    

    public $newImage; 

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->fillFromModel();
    }

    public function fillFromModel()
    {
        $this->name = $this->product->name;
        $this->description = $this->product->description ?? '';
        $this->price = $this->product->price;
        $this->stock = $this->product->stock;
        $this->productImage = $this->product->image;

        $this->createdAt = $this->product->created_at;
        $this->updatedAt = $this->product->updated_at;
    }

    public function toggleEdit()
    {
        $this->editMode = !$this->editMode;
    }

    public function cancelEdit()
    {
        $this->editMode = false;
        $this->product->refresh();
        $this->fillFromModel();
        $this->newImage = null;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'newImage' => 'nullable|image|max:2048', 
        ]);

        if ($this->newImage) {
            Storage::disk('public')->delete($this->product->image);

            $path = $this->newImage->store('products', 'public');
            $this->product->image = $path;
        }

        $this->product->name = $this->name;
        $this->product->description = $this->description;
        $this->product->price = $this->price;
        $this->product->stock = $this->stock;
        $this->product->save();

        $this->editMode = false;
        $this->newImage = null;

        $this->dispatch('show-toast', message: 'Data produk berhasil diperbarui!.');

    }

    public function render()
    {
        return view('livewire.product.show')
            ->layout('components.layouts.app', ['title' => 'Detail Produk']);
    }
}
