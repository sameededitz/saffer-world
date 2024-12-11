<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminAdd extends Component
{
    #[Validate('required|string|max:255|unique:users,name')]
    public $name;

    #[Validate('required|email|max:255|unique:users,email')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ];
    }

    public function signup()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
        ]);

        return redirect()->route('all-admins')->with([
            'status' => 'success',
            'message' => 'Admin Added Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.admin-add');
    }
}
