<?php
namespace App\Livewire\umkmprofile;

use App\Models\Umkm;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UmkmInformation extends Component
{
    public $umkm;
    public $categories;
    public $progress = 0;
    public $username;
    public $is_complete = false;

    public function mount()
    {
        $this->umkm = Umkm::where('user_id', Auth::id())->with('categories', 'user')->firstOrFail();
        $this->categories = $this->umkm->categories;
        $this->username = $this->umkm->user->name;

        if ($this->umkm) {
            $fields = [
                'umkm_name',
                'description',
                'location',
                'phone',
                'image',
            ];

            $filled = collect($fields)->filter(function ($field) {
                return !empty($this->umkm->$field);
            })->count();

            if ($this->categories->isNotEmpty()) {
                $filled++;
            }

            $total = count($fields) + 1;  
            $this->progress = round(($filled / $total) * 100);

            if ($this->progress == 100) {
                $this->is_complete = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.umkm-profile.umkm-information', [
            'umkm' => $this->umkm,
            'categories' => $this->categories,
            'progress' => $this->progress,
            'is_complete' => $this->is_complete,
            'username' => $this->username,
        ])->layout('components.layouts.app');
    }
}
