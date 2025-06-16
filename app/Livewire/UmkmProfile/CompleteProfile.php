<?php

namespace App\Livewire\umkmprofile;

use Livewire\Component;
use App\Models\Category;
use App\Models\Umkm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CompleteProfile extends Component
{
    public $step = 1;
    public $totalStep = 2;
    public $selectedCategories = [];
    public $umkm_name = '';
    public $showModal = false;
    public $message = '';
    public $categories;
    public $errorMessage = '';
    public $is_profile_complete = false;

    protected $rules = [
        'selectedCategories' => 'required|array|min:1|max:3',
        'umkm_name' => 'required|string|min:3|max:255',
    ];

    protected $messages = [
        'selectedCategories.required' => 'Pilih setidaknya satu kategori.',
        'selectedCategories.min' => 'Pilih setidaknya satu kategori.',
        'selectedCategories.max' => 'Maksimal pilih tiga kategori.',
        'umkm_name.required' => 'Nama UMKM wajib diisi.',
        'umkm_name.min' => 'Nama UMKM minimal 3 karakter.',
        'umkm_name.max' => 'Nama UMKM maksimal 255 karakter.',
    ];

    public function mount()
    {
        $this->categories = Category::all();
        Log::info('CompleteProfile mounted', ['categories_count' => $this->categories->count()]);
        if ($this->categories->isEmpty()) {
            $this->errorMessage = 'Tidak ada kategori yang tersedia. Silakan tambahkan kategori terlebih dahulu.';
            Log::warning('No categories found in database');
        }
    }

    public function toggleCategory($categoryId)
    {
        Log::info('toggleCategory called', ['categoryId' => $categoryId, 'selectedCategories' => $this->selectedCategories]);
        if (in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);
        } elseif (count($this->selectedCategories) < 3) {
            $this->selectedCategories[] = $categoryId;
        }
        $this->selectedCategories = array_values($this->selectedCategories);
    }

    public function nextStep()
    {
        Log::info('nextStep called', ['current_step' => $this->step]);
        if ($this->step == 1) {
            $this->validate([
                'selectedCategories' => 'required|array|min:1|max:3',
            ], $this->messages);
        }
        if ($this->step < $this->totalStep) {
            $this->step++;
        }
    }

    public function prevStep()
    {
        Log::info('prevStep called', ['current_step' => $this->step]);
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function save()
    {
        Log::info('save method called', [
            'selectedCategories' => $this->selectedCategories,
            'umkm_name' => $this->umkm_name,
            'user_id' => Auth::id()
        ]);

        if (!Auth::check()) {
            $this->errorMessage = 'Anda harus login untuk menyimpan data UMKM.';
            Log::error('User not authenticated in CompleteProfile save');
            return;
        }

        try {
            $this->validate();

            DB::beginTransaction();

            $umkm = Umkm::create([
                'user_id' => Auth::id(),
                'umkm_name' => $this->umkm_name,

            ]);
            
            $umkm->categories()->sync($this->selectedCategories);
            $umkm->is_profile_complete = true;
            $umkm->save();
        

            DB::commit();

            $this->showModal = true;
            $this->message = 'Data UMKM berhasil disimpan!';
            Log::info('UMKM saved successfully', ['umkm_id' => $umkm->id]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->errorMessage = 'Validasi gagal: ' . implode(', ', $e->errors()[array_key_first($e->errors())]);
            Log::error('Validation error in UMKM save', ['errors' => $e->errors()]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage();
            Log::error('Error saving UMKM', ['error' => $e->getMessage()]);
        }
        return redirect()->route('dashboard');

    }

    public function redirectToDashboard()
    {
        Log::info('redirectToDashboard called');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.umkm-profile.complete-profile');
    }
}