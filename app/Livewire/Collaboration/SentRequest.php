<?php
namespace App\Livewire\Collaboration;

use App\Models\Collaboration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SentRequest extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $searchInput = '';
    public $statusInput = '';

    public function updatingSearchInput()
    {
        $this->resetPage();
    }

    public function updatingStatusInput()
    {
        $this->resetPage();
    }



    public function search(){
        $this->resetPage();
    }

    public function render()
    {
        $query = Collaboration::query()
            ->with('partnerUmkm')
            ->where('initiator_umkm_id', Auth::user()->umkm->id);

        if ($this->searchInput) {
            $query->whereHas('partnerUmkm', function ($q) {
                $q->where('umkm_name', 'like', '%' . $this->searchInput . '%');
            });
        }

        if ($this->statusInput) {
            $query->where('status', $this->statusInput);
        }

        $requests = $query->latest()->paginate(10);

        return view('livewire.collaboration.sent-request', [
            'requests' => $requests,
        ]);
    }
}