<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminChangePassword extends Component
{
    #[Validate]
    public $password;

    #[Validate]
    public $newpassword;

    #[Validate]
    public $password_confirmation;

    public function rules()
    {
        return [
            'password' => 'required',
            'newpassword' => 'required|min:8',
            'password_confirmation' => 'required|string|same:newpassword',
        ];
    }

    public function update()
    {
        $this->validate();
        $user = Auth::user();
        // dd($user);
        if (!Hash::check($this->password, $user->password)) {
            return $this->addError('password', 'Current password is incorrect.');
        }

        $user->password = Hash::make($this->newpassword);
        /**
         * @var \App\Models\User $user
         */
        $user->save();

        $session = app('session');
        $session->flash('status', 'success');
        $session->flash('message', 'Password Updated Successfully');

        $this->dispatch('passwordChanged');

        $this->password = '';
        $this->newpassword = '';
        $this->password_confirmation = '';
    }
    public function render()
    {
        return view('livewire.admin-change-password');
    }
}
