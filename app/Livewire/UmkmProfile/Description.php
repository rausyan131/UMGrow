<?php

namespace App\Livewire\UmkmProfile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Umkm;


class Description extends Component
{
    public $umkm;

    public function mount()
    {
        $this->umkm = Umkm::where('user_id', Auth::id())->with('categories', 'user')->firstOrFail();
    }

    public function render()
    {
        return view('livewire.umkm-profile.description');
    }
}
