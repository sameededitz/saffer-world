<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserAdd extends Component
{
    #[Validate]
    public $name;

    #[Validate]
    public $email;

    #[Validate]
    public $password;

    #[Validate]
    public $password_confirmation;

    #[Validate]
    public $role;

    #[Validate]
    public $device_limit;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:company,normal',
            'device_limit' => 'nullable|integer|min:1',
        ];
    }

    public function submit()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'device_limit' => $this->device_limit ?? null,
            'email_verified_at' => Carbon::now(),
            'role' => $this->role
        ]);

        $user->assignFreeTrial();

        return redirect()->route('all-users')->with([
            'status' => 'success',
            'message' => 'User Added Successfully',
        ]);
    }
    public function render()
    {
        return view('livewire.user-add');
    }
}
