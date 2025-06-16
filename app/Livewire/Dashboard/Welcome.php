<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Umkm;


class Welcome extends Component
{
    public $is_complate = false;
    public $progress = 0;
    public $username;


    public function render()
    {
        $user = Auth::user();
        $this->username = $user->name;
        
        $umkm = Umkm::where('user_id', $user->id)->first();

        if ($umkm) {
            $fields = [
                'umkm_name',
                'description',
                'location',
                'phone',
                'image',
            ];

            $filled = collect($fields)->filter(function ($field) use ($umkm) {
                return !empty($umkm->$field);
            })->count();

            $this->progress = round(($filled / count($fields)) * 100);

            if ($this->progress === 100 && !$umkm->is_profile_complete) {
                $this->is_complate = true;
            }
        }

        return view('livewire.dashboard.welcome',[
            'progress' => $this->progress,
            'is_complate' => $this->is_complate,
            'username' => $this->username
        ]);
    }
}
