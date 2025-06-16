<?php

namespace App\Livewire\Collaboration;

use App\Models\Collaboration;
use Livewire\Component;

class SentRequestDetail extends Component
{
    public $request;

    public function mount($id)
    {
        $this->request = Collaboration::with('partnerUmkm')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.collaboration.sent-request-detail')
        ->layout('components.layouts.app',['title' => 'Detail Ajuan']);
    }
}