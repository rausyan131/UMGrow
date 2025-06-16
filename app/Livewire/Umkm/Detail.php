<?php

namespace App\Livewire\Umkm;

use App\Models\Umkm;
use App\Models\Collaboration;
use Livewire\Component;

class Detail extends Component
{
    public $umkm;
    public $categories = [];
    public bool $showCollabModal = false;

    public $collabStatus = 'none';
    public $currentCollab;

    public $showPreviewCertificates = false;
    public $previewFilenameCertificates;

    public $showPreviewGallery = false;
    public $previewFilenameGallery;

    public function mount($id)
    {
        $this->umkm = Umkm::with(['user', 'categories'])->findOrFail($id);
        $this->categories = $this->umkm->categories;
    
        $myUmkmId = auth()->user()->umkm->id ?? null;
    
        $this->collabStatus = 'none';
        $this->currentCollab = null;
    
        if ($myUmkmId && $myUmkmId !== $this->umkm->id) {
            $collab = Collaboration::where(function ($q) use ($myUmkmId) {
                $q->where('initiator_umkm_id', $myUmkmId)
                  ->where('partner_umkm_id', $this->umkm->id);
            })->orWhere(function ($q) use ($myUmkmId) {
                $q->where('initiator_umkm_id', $this->umkm->id)
                  ->where('partner_umkm_id', $myUmkmId);
            })->latest()->first();
    
            if ($collab) {
                $this->currentCollab = $collab;
                $this->collabStatus = $collab->status;
            }
        }
    }
    

    public function showCertificatePreview($filename)
    {
        $this->previewFilenameCertificates = $filename;
        $this->showPreviewCertificates = true;
    }

    public function showGalleryPreview($filename)
    {
        $this->previewFilenameGallery = $filename;
        $this->showPreviewGallery = true;
    }

    public function closePreview()
    {
        $this->showPreviewCertificates = false;
        $this->previewFilenameCertificates = null;

        $this->showPreviewGallery = false;
        $this->previewFilenameGallery = null;
    }

     public function openCollabModal()
    {
        $this->showCollabModal = true;
    }
    
    public function closeCollabModal()
    {
        $this->showCollabModal = false;
    }

    public function render()
    {
        return view('livewire.umkm.detail')
            ->layout('components.layouts.app', [
                'title' => $this->umkm->umkm_name,
            ]);
    }
}
