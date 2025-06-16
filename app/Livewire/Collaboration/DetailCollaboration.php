<?php

namespace App\Livewire\Collaboration;

use Livewire\Component;
use Livewire\Attributes\Url;

use App\Models\Collaboration;

class DetailCollaboration extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    
    #[Url(as: 'tab', history: true)]

    public string $tab = 'collaboration-product';

    public function setTab(string $value)
    {
        $this->tab = $value;
    }

    public function render()
    {
        $collaboration = Collaboration::findOrFail($this->id);
    
        return view('collaboration.detail', [
            'collaboration' => $collaboration, 
        ])->layout('components.layouts.app', [
            'title' => 'Kolaborasi Detail',
        ]);
    }
    
 

}
