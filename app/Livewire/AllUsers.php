<?php

namespace App\Livewire;

use App\Models\Plan;
use App\Models\Purchase;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AllUsers extends Component
{
    public $users;
    public $selectedUser;
    public $plans;
    #[Validate]
    public $plan_id;

    protected  function rules()
    {
        return [
            'plan_id' => 'required|exists:plans,id',
        ];
    }

    public function mount()
    {
        // Load all users with the 'customer' role
        $this->users = User::where('role', '!=', 'admin')
            ->with(['purchases' => function ($query) {
                $query->latest()->first();
            }])
            ->get();

        $this->plans = Plan::all();
    }

    public function addPurchase()
    {
        $this->validate();

        $plan = Plan::find($this->plan_id);

        $expirationDate = match ($plan->duration) {
            'daily' => now()->addDay(),
            'weekly' => now()->addWeek(),
            'monthly' => now()->addMonth(),
            '3-month' => now()->addMonths(3),
            '6-month' => now()->addMonths(6),
            'yearly' => now()->addYear(),
            '2-year' => now()->addYears(2),
            '3-year' => now()->addYears(3),
            default => now()->addDays(2),
        };

        $this->selectedUser->purchases()->create([
            'plan_id' => $plan->id,
            'started_at' => now(),
            'expires_at' => $expirationDate,
            'is_active' => true,
        ]);

        $this->selectedUser = null;
        $this->plan_id = '';

        // Reload users to update the table
        $this->mount();

        $this->dispatch('close-modal');
        $this->dispatch('alert_add', ['type' => 'success', 'message' => 'Purchase added successfully!']);
    }

    public function openModal(User $user)
    {
        $this->selectedUser = $user;
        $this->plan_id = '';
        $this->dispatch('open-modal');
    }

    public function clearPurchase(User $user)
    {
        $user->purchases()->delete();
        // Reload users to update the table
        $this->mount();

        $this->dispatch('alert_clear', ['type' => 'success', 'message' => 'Purchase cleared successfully!']);
    }

    public function render()
    {
        return view('livewire.all-users');
    }
}
