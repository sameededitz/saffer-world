<?php

namespace App\Livewire;

use Livewire\Component;

class UpdateLimit extends Component
{
    public $user;
    public $limit;

    public function mount($user)
    {
        $this->user = $user;
        $this->limit = $user->device_limit;
    }

    public function update()
    {
        $this->validate([
            'limit' => 'nullable|integer',
        ]);
    
        $this->user->device_limit = $this->limit !== '' ? $this->limit : null;
        $this->user->save();

        $this->dispatch('updatedLimit');
    }

    public function render()
    {
        return view('livewire.update-limit');
    }
}
