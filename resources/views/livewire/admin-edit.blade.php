<div>
    @if ($errors->any())
        <div class="py-2">
            @foreach ($errors->all() as $error)
                <x-alert type="danger" :message="$error" />
            @endforeach
        </div>
    @endif
    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="row gy-3">
            <div class="col-12">
                <label class="form-label">Name</label>
                <input type="text" wire:model.live="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-12">
                <label class="form-label">Email</label>
                <input type="text" wire:model.live="email" class="form-control" placeholder="Email">
            </div>
            <div class="col-12">
                <label class="form-label">Role</label>
                <select class="form-select" wire:model="role">
                    <option selected>Select Status</option>
                    <option value="admin">Admin</option>
                    <option value="company">Customer</option>
                    <option value="normal">Normal</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary-600">Update</button>
            </div>
        </div>
    </form>
</div>
