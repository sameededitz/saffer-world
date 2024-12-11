<?php

namespace App\Livewire;

use App\Models\Server;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServerEdit extends Component
{
    use WithFileUploads;

    public $server;

    #[Validate]
    public $image;

    #[Validate]
    public $name;

    #[Validate]
    public $type;

    #[Validate]
    public $status;

    public function mount(Server $server)
    {
        $this->server = $server;
        $this->name = $server->name;
        $this->status = $server->status;
        $this->type = $server->type;
    }

    public function rules()
    {
        return [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp,gif,bmp|max:20480',
            'name' => 'required|string',
            'type' => 'required|in:company,normal',
            'status' => 'required|in:1,0',
            
        ];
    }

    public function update()
    {
        $this->validate();
        $this->server->update([
            'name' => $this->name,
            'status' => $this->status,
            'type' => $this->type,
        ]);

        if ($this->image) {
            $this->server->clearMediaCollection('image');
            $this->server->addMedia($this->image->getRealPath())
                ->usingFileName($this->image->getClientOriginalName())
                ->toMediaCollection('image');
        }

        return redirect()->route('all-servers')->with([
            'status' => 'success',
            'message' => 'Server Updated Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.server-edit');
    }
}
