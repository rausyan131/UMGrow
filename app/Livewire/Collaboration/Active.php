<?php

namespace App\Livewire\Collaboration;

use App\Models\Collaboration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Active extends Component
{
    public $search = '';

    public function render()
    {
        $umkmId = Auth::user()->umkm->id;
        $search = strtolower($this->search);
    
        $collaborations = Collaboration::with(['initiatorUmkm', 'partnerUmkm'])
            ->where(function ($query) use ($umkmId) {
                $query->where('initiator_umkm_id', $umkmId)
                      ->orWhere('partner_umkm_id', $umkmId);
            })
            ->where('status', 'accepted')
            ->where(function ($query) use ($umkmId, $search) {
                $query->whereHas('initiatorUmkm', function ($q) use ($umkmId, $search) {
                    $q->where('id', '!=', $umkmId)
                      ->whereRaw('LOWER(umkm_name) LIKE ?', ["%$search%"]);
                })->orWhereHas('partnerUmkm', function ($q) use ($umkmId, $search) {
                    $q->where('id', '!=', $umkmId)
                      ->whereRaw('LOWER(umkm_name) LIKE ?', ["%$search%"]);
                });
            })
            ->latest()
            ->get();
    
        return view('livewire.collaboration.active', [
            'collaborations' => $collaborations,
        ]);
    }
    
}
