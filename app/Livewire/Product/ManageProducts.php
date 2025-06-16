<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageProducts extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'tailwind';

    public $name, $description, $price, $stock, $image;
    public $search = '';
    public $filterDate;
    public $deleteMode = false;
    public $selectedProducts = [];
    public $formKey;

    public function mount(){
    $this->formKey = uniqid(); 
    
    }

    public function searchProducts(){
         $this->resetPage();
    }


    public function toggleSelect($id)
    {
        if (in_array($id, $this->selectedProducts)) {
            $this->selectedProducts = array_diff($this->selectedProducts, [$id]);
        } else {
            $this->selectedProducts[] = $id;
        }
    }

    public function toggleDeleteMode()
    {
        $this->deleteMode = !$this->deleteMode;
        $this->selectedProducts = [];
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|max:2048',
        ]);

        $path = $this->image->store('products', 'public');

        Product::create([
            'umkm_id' => Auth::user()->umkm->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $path,
        ]);

        $this->dispatch('show-toast', message: 'Produk berhasil ditambah!');

        $this->reset(['name', 'description', 'price', 'stock', 'image']);
        $this->formKey = uniqid();
    }

    public function deleteSelected()
    {
        if (count($this->selectedProducts) === 0) {
            session()->flash('error', 'Tidak ada produk yang dipilih untuk dihapus.');
            return;
        }

        $products = Product::whereIn('id', $this->selectedProducts)->get();

        foreach ($products as $product) {
            Storage::disk('public')->delete($product->image);
            $product->delete();
        }

        $this->selectedProducts = [];
        $this->deleteMode = false;


        $this->dispatch('show-toast', message: 'Produk yang dipilih berhasil dihapus.');
    }

    public function render()
    {
        $query = Product::query()
            ->where('umkm_id', Auth::user()->umkm->id);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->filterDate) {
            $query->whereDate('created_at', $this->filterDate);
        }

        $products = $query->latest()->paginate(8);

        return view('livewire.product.manage-products', [
            'products' => $products,
        ]);
    }

    
}
