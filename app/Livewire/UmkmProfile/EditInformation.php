<?php

namespace App\Livewire\UmkmProfile;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Umkm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EditInformation extends Component
{
    use WithFileUploads;

    public $umkm;
    public $umkm_name;
    public $username;
    public $location;
    public $description;
    public $website_url;
    public $instagram_url;
    public $facebook_url;
    public $phone;
    public $image;
    public $categories;
    public $selectedCategories = [];
    public $message = '';
    public $errorMessage = '';
    public $showCategoryModal = false;

    protected $rules = [
        'umkm_name' => 'required|string|min:3|max:255',
        'username' => 'required|string|min:3|max:255',
        'location' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'website_url' => 'nullable|string|max:255',
        'instagram_url' => 'nullable|string|max:255',
        'facebook_url' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'selectedCategories' => 'required|array|min:1|max:3',
        'image' => 'nullable|image',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->umkm = Umkm::where('user_id', $user->id)->with('categories')->firstOrFail();

        $this->umkm_name = $this->umkm->umkm_name;
        $this->username = $this->umkm->user->name;
        $this->location = $this->umkm->location;
        $this->description = $this->umkm->description;
        $this->website_url = $this->umkm->website_url;
        $this->instagram_url = $this->umkm->instagram_url;
        $this->facebook_url = $this->umkm->facebook_url;
        $this->phone = $this->umkm->phone;
        $this->selectedCategories = $this->umkm->categories->pluck('id')->toArray();

        $this->categories = Category::all();
    }

    public function toggleCategory($categoryId)
    {
        if (in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);
        } elseif (count($this->selectedCategories) < 3) {
            $this->selectedCategories[] = $categoryId;
        }
        $this->selectedCategories = array_values($this->selectedCategories);
    }

    public function toggleCategoryModal()
    {
        $this->showCategoryModal = !$this->showCategoryModal;
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            if ($this->image) {
                $filename = $this->image->store('umkm/profile', 'public');
                $this->umkm->image = basename($filename);
            }

            $this->umkm->update([
                'umkm_name' => $this->umkm_name,
                'location' => $this->location,
                'description' => $this->description,
                'website_url' => $this->website_url,
                'instagram_url' => $this->instagram_url,
                'facebook_url' => $this->facebook_url,
                'phone' => $this->phone,
            ]);

            $this->umkm->user->update([
                'name' => $this->username,
            ]);

            $this->umkm->categories()->sync($this->selectedCategories);

            DB::commit();

        
            $this->dispatch('show-toast', message: 'Profile UMKM Berhasil Diperbarui');


        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage();
            Log::error('Error updating UMKM profile', ['error' => $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.umkm-profile.edit-information');
    }
}