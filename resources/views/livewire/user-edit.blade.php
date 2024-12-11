<div>
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Customers</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('admin-home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Users</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Edit User</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="py-2">
                            @foreach ($errors->all() as $error)
                                <x-alert type="danger" :message="$error" />
                            @endforeach
                        </div>
                    @endif
                    <form wire:submit.prevent="update">
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
                                <select wire:model.live="role" class="form-control" required>
                                    <option selected>Select Type</option>
                                    <option value="company">Company</option>
                                    <option value="normal">Normal</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Device Limit</label>
                                <input type="number" wire:model.live="device_limit" class="form-control"
                                    placeholder="Device Limit">
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary-600">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- card end -->
        </div>
    </div>
</div>
