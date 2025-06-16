<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Umkm;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterForm extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    // Validasi rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    // Custom pesan error
    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'name.string' => 'Nama lengkap harus berupa teks.',
        'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',

        'email.required' => 'Email wajib diisi.',
        'email.string' => 'Email harus berupa teks.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
        'email.unique' => 'Email tersebut sudah terdaftar.',

        'password.required' => 'Password wajib diisi.',
        'password.string' => 'Password harus berupa teks.',
        'password.min' => 'Password minimal terdiri dari 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function register()
    {
        $this->validate(); 

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);


        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function render()
    {
        return view('livewire.auth.register-form')->layout('components/layouts/guest',['title' => 'Register']);
    }
}
