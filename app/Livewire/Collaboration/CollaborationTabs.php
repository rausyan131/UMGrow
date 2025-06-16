<?php

namespace App\Livewire\Collaboration;

use Livewire\Component;
use Livewire\Attributes\Url;

class CollaborationTabs extends Component
{
    #[Url(as: 'tab', history: true)]

    public string $tab = 'active';

    public function setTab(string $value)
    {
        $this->tab = $value;
    }

    public function render()
    {
        return view('collaboration.index')
        ->layout('components.layouts.app',['title' => 'Kolaborasi']);
    }
 

}
