<?php

namespace App\Livewire\Collaboration;

use App\Models\Collaboration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReceivedRequestDetail extends Component
{
    public $request;
    public $showRejectModal = false;
    public $rejectionReason = '';

    public function mount($id)
    {
        $umkmId = Auth::user()->umkm->id ?? null;

        if (!$umkmId) {
            abort(403, 'UMKM tidak ditemukan.');
        }

        $this->request = Collaboration::with(['initiatorUmkm', 'products'])
            ->where('id', $id)
            ->where('partner_umkm_id', $umkmId)
            ->firstOrFail();
    }

    public function rejectConfirmation()
    {
        $this->showRejectModal = true;
    }

    public function cancelReject()
    {
        $this->showRejectModal = false;
        $this->rejectionReason = '';
    }

    public function confirmReject()
    {
        $this->validate([
            'rejectionReason' => 'required|string|max:500',
        ]);

        $this->request->update([
            'status' => 'rejected',
            'rejection_reason' => $this->rejectionReason,
        ]);

        $this->showRejectModal = false;
        session()->flash('message', 'Permintaan kolaborasi telah ditolak.');
    }

    public function accept()
    {
        $this->request->update([
            'status' => 'accepted',
        ]);

        session()->flash('message', 'Permintaan kolaborasi telah diterima.');
    }

    public function render()
    {
        return view('livewire.collaboration.received-request-detail')
        ->layout('components.layouts.app',['title' => 'Detail Permintaan']);
    }
}
