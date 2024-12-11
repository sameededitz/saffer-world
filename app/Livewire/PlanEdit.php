<?php

namespace App\Livewire;

use App\Models\Plan;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PlanEdit extends Component
{
    public $plan;

    #[Validate]
    public $name;

    #[Validate]
    public $description;

    #[Validate]
    public $price;

    #[Validate]
    public $duration;

    #[Validate]
    public $type;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'description' => 'nullable|string|max:100',
            'price' => 'required',
            'duration' => 'required|in:daily,weekly,monthly,3-month,6-month,yearly,2-year,3-year',
            'type' => 'required|in:trial,non_trial',
        ];
    }

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->name = $plan->name;
        $this->description = $plan->description;
        $this->price = $plan->price;
        $this->duration = $plan->duration;
        $this->type = $plan->type;
    }

    public function update()
    {
        $this->validate();
        $this->plan->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'type' => $this->type,
        ]);
        return redirect()->route('all-plans')->with([
            'status' => 'success',
            'message' => 'Plan Updated Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.plan-edit');
    }
}
