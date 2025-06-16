<?php

namespace App\Livewire\Collaboration;

use App\Models\Collaboration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReceivedRequest extends Component
{
    public $requests;
    public $searchInput = '';
    public $statusInput = '';

    public function mount()
    {
        $this->loadRequests();
    }

    public function search()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        $myUmkmId = Auth::user()->umkm->id ?? null;

        if (!$myUmkmId) {
            abort(403, 'UMKM tidak ditemukan.');
        }

        $query = Collaboration::with('initiatorUmkm')
            ->where('partner_umkm_id', $myUmkmId);

        if ($this->searchInput) {
            $query->whereHas('initiatorUmkm', function ($q) {
                $q->where('umkm_name', 'like', '%' . $this->searchInput . '%');
            });
        }

        if ($this->statusInput) {
            $query->where('status', $this->statusInput);
        }

        $this->requests = $query->latest()->get();
    }

    public function render()
    {
        return view('livewire.collaboration.received-request');
    }
}
