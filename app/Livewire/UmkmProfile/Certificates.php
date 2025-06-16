<?php

namespace App\Livewire\UmkmProfile;

use App\Models\Umkm;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Certificates extends Component
{
    use WithFileUploads;

    public $certificate;
    public $previewUrl;
    public $ShowModalCertificates = false;
    public $showCertificates = false;
    public $selectedCertificates = [];


    protected $rules = [
        'certificate' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ];
    
    protected $messages = [
        'certificate.required' => 'File sertifikat harus diunggah.',
        'certificate.image' => 'File harus berupa gambar.',
        'certificate.mimes' => 'Format gambar tidak valid. Gunakan JPG, JPEG, atau PNG.',
        'certificate.max' => 'Ukuran gambar maksimal adalah 2 MB.',
    ];

    public function updatedCertificate()
    {
        $this->validateOnly('certificate');

        if ($this->certificate) {
            $this->previewUrl = $this->certificate->temporaryUrl();
            $this->ShowModalCertificates = true;
        }
    }

    public function cancel()
    {
        $this->reset(['certificate', 'previewUrl', 'ShowModalCertificates']);
    }


    

    public function uploadSertificate()
    {
        $this->validate();
      
        $filename = $this->certificate->store('umkm/certificates', 'public');

        $umkm = auth()->user()->umkm;
        $certificates = $umkm->certificates ?? [];

        $certificates[] = basename($filename);
        $umkm->certificates = $certificates;
        $umkm->save();

        $this->dispatch('show-toast', message: 'Sertifikat Berhasil Ditambah');
        $this->reset(['certificate', 'previewUrl', 'ShowModalCertificates']);
        $this->dispatch('sertifikat-uploaded');

    }

    public function toggleGallery()
    {
        $this->showCertificates = !$this->showCertificates;
        $this->selectedCertificates = [];
    }

    public function toggleSelection($certificate)
    {
        if (in_array($certificate, $this->selectedCertificates)) {
            $this->selectedCertificates = array_diff($this->selectedCertificates, [$certificate]);
        } else {
            $this->selectedCertificates[] = $certificate;
        }
    }

    public function deleteSelected()
    {
        $umkm = auth()->user()->umkm;
        $certificates = $umkm->certificates ?? [];

        foreach ($this->selectedCertificates as $selected) {
            Storage::disk('public')->delete('umkm/certificates/' . $selected);
            $certificates = array_values(array_diff($certificates, [$selected]));
        }

        $umkm->certificates = $certificates;
        $umkm->save();

        $this->selectedCertificates = [];
        $this->showCertificates = false;

        session()->flash('success', 'Sertifikat terpilih berhasil dihapus!');
        return redirect()->route('profile.detail-umkm');


    }

    public function render()
    {
        return view('livewire.umkm-profile.certificates', [
            'umkm' => Umkm::where('user_id', Auth::id())->first(),
        ]);
    }
}
