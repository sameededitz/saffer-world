<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminEdit extends Component
{
    public $admin;

    #[Validate]
    public $name;

    #[Validate]
    public $email;

    #[Validate]
    public $role;

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:users,name,' . $this->admin->id,
            'email' => 'required|email|unique:users,email,' . $this->admin->id,
            'role' => 'required|in:admin,company,normal',
        ];
    }

    public function mount(User $user)
    {
        $this->admin = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function update()
    {
        $this->validate();

        $this->admin->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        return redirect()->route('all-admins')->with([
            'status' => 'success',
            'message' => 'Admin Updated Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.admin-edit');
    }
}
