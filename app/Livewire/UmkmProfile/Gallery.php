<?php

namespace App\Livewire\UmkmProfile;

use App\Models\Umkm;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Gallery extends Component
{
    use WithFileUploads;

    public $galleryUpload = [];
    public $showGallery = false;
    public $selectedGallery = [];

    public function uploadGallery()
    {
        $this->validate([
            'galleryUpload.*' => 'image|max:2048',
        ]);

        $umkm = auth()->user()->umkm;
        $gallery = $umkm->gallery ?? [];

        foreach ($this->galleryUpload as $image) {
            $filename = $image->store('umkm/gallery', 'public');
            $gallery[] = basename($filename);
        }

        $umkm->gallery = $gallery;
        $umkm->save();

        $this->dispatch('show-toast', message: 'Foto berhasil ditambahkan ke galeri!');

        $this->reset(['galleryUpload']);
        $this->dispatch('galeri-uploaded');
    }

    public function toggleGallery()
    {
        $this->showGallery = !$this->showGallery;
        $this->selectedGallery = [];
    }

    public function toggleSelection($photo)
    {
        if (in_array($photo, $this->selectedGallery)) {
            $this->selectedGallery = array_diff($this->selectedGallery, [$photo]);
        } else {
            $this->selectedGallery[] = $photo;
        }
    }

    public function deleteGallerySelected()
    {
        $umkm = auth()->user()->umkm;
        $gallery = $umkm->gallery ?? [];

        foreach ($this->selectedGallery as $selected) {
            Storage::disk('public')->delete('umkm/gallery/' . $selected);
            $gallery = array_values(array_diff($gallery, [$selected]));
        }

        $umkm->gallery = $gallery;
        $umkm->save();

        $this->selectedGallery = [];
        $this->showGallery = false;

      

        $this->dispatch('show-toast', message: 'Foto Galeri berhasil dihapus!');

    }

    public function render()
    {
        return view('livewire.umkm-profile.gallery', [
            'umkm' => Umkm::where('user_id', Auth::id())->first(),
        ]);
    }
}
