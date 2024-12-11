<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserEdit extends Component
{
    public $user;

    #[Validate]
    public $name;

    #[Validate]
    public $email;
    #[Validate]
    public $role;
    #[Validate]
    public $device_limit;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->device_limit = $user->device_limit;
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'role' => 'required|in:company,normal',
            'device_limit' => 'nullable|integer|min:1',
        ];
    }

    public function update()
    {
        $this->validate();
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'device_limit' => $this->device_limit
        ]);

        return redirect()->route('all-users')->with([
            'status' => 'success',
            'message' => 'User Updated Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.user-edit');
    }
}
