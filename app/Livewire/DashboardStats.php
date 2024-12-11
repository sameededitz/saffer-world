<?php

namespace App\Livewire;

use App\Models\Server;
use App\Models\Streaming;
use App\Models\User;
use Livewire\Component;

class DashboardStats extends Component
{
    public $userCount;
    public $serverCount;

    public function mount()
    {
        $this->userCount = User::count();
        $this->serverCount = Server::count();
    }
    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
