<?php

namespace App\Livewire;

use App\Models\Server;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServerCreate extends Component
{
    use WithFileUploads;

    #[Validate]
    public $image;

    #[Validate]
    public $name;

    #[Validate]
    public $type;

    #[Validate]
    public $status;

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,gif,bmp|max:20480',
            'name' => 'required|string',
            'type' => 'required|in:company,normal',
            'status' => 'required|in:1,0',
            
        ];
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function submit()
    {
        $this->validate();
        $server = Server::create([
            'name' => $this->name,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        if ($this->image) {
            $server->addMedia($this->image->getRealPath())
                ->usingFileName($this->image->getClientOriginalName())
                ->toMediaCollection('image');
        }
        return redirect()->route('all-servers')->with([
            'status' => 'success',
            'message' => 'Server Added Successfully',
        ]);
    }
    public function render()
    {
        return view('livewire.server-create');
    }
}
