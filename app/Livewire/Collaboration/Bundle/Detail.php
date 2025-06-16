<?php

namespace App\Livewire\Collaboration\Bundle;

use Livewire\Component;
use App\Models\CollaborationProductBundle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $bundleId;
    public $bundle;

    public $editMode = false;

    public $title, $description, $price, $notes, $status, $thumbnailFile;

    public function mount($bundleId)
    {
        $this->bundleId = $bundleId;
        $this->loadBundle();
    }

    public function loadBundle()
    {
        $this->bundle = CollaborationProductBundle::with(['creator', 'editor', 'products'])
            ->findOrFail($this->bundleId);

        $this->title = $this->bundle->title;
        $this->description = $this->bundle->description;
        $this->price = $this->bundle->price;
        $this->notes = $this->bundle->notes;
        $this->status = $this->bundle->status;
    }

    public function toggleEdit()
    {
        $this->editMode = !$this->editMode;

        if (!$this->editMode) {
            $this->loadBundle(); 
        }
    }

    public function updateBundle()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|in:draft,active,inactive,archived',
            'thumbnailFile' => 'nullable|image|max:2048',
        ]);
        

        if ($this->thumbnailFile) {
            if ($this->bundle->thumbnail && Storage::disk('public')->exists($this->bundle->thumbnail)) {
                Storage::disk('public')->delete($this->bundle->thumbnail);
            }

            $path = $this->thumbnailFile->store('thumbnails', 'public');
            $this->bundle->thumbnail = $path;
        }

        $this->bundle->title = $this->title;
        $this->bundle->description = $this->description;
        $this->bundle->price = $this->price;
        $this->bundle->notes = $this->notes;
        $this->bundle->status = $this->status;
        $this->bundle->updated_by = Auth::id();
        $this->bundle->save();

        $this->editMode = false;

        $this->bundle = $this->bundle->fresh(['creator', 'editor', 'products']);

        $this->dispatch('show-toast', message: 'Bundling berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.collaboration.bundle.detail');
    }
}
