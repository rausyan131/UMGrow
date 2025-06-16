<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{


    public function render()
    {
    

        return view('dashboard.index')
        ->layout('components.layouts.app', [
            'title' => 'Dashboard',
        ]);
    }
}
