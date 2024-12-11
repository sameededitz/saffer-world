<div>
    @if ($errors->any())
        <div class="py-2">
            @foreach ($errors->all() as $error)
                <x-alert type="danger" :message="$error" />
            @endforeach
        </div>
    @endif
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <div class="row gy-3">
            <div class="col-12">
                <label class="form-label">Name</label>
                <input type="text" wire:model.live="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" wire:model.live="email" class="form-control" placeholder="Email">
            </div>
            <div class="col-12 position-relative">
                <label class="form-label">Password</label>
                <input type="password" wire:model.live="password" class="form-control" placeholder="Password"
                    id="new-password">
                <span
                    class="toggle-password ri-eye-line cursor-pointer position-absolute translate-middle-y me-16 text-secondary-light"
                    data-toggle="#new-password" style="top: 73%; right: 12px; font-size: 19px;"></span>
            </div>
            <div class="col-12 position-relative">
                <label class="form-label">Confirm Password</label>
                <input type="password" wire:model="password_confirmation" class="form-control"
                    placeholder="Confirm Password" id="password-2">
                <span
                    class="toggle-password ri-eye-line cursor-pointer position-absolute translate-middle-y me-16 text-secondary-light"
                    data-toggle="#password-2" style="top: 73%; right: 12px; font-size: 19px;"></span>
            </div>
            <div class="col-12">
                <label class="form-label">Role</label>
                <select wire:model.live="role" class="form-control" required>
                    <option selected>Select Type</option>
                    <option value="company">Company</option>
                    <option value="normal">Normal</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Device Limit</label>
                <input type="number" wire:model.live="device_limit" class="form-control" placeholder="Device Limit">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary-600">Save</button>
            </div>
        </div>
    </form>
</div>
