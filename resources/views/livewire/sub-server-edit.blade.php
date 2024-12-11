<div>
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Sub Servers</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('admin-home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Sub Servers</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Add Sub Server</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="py-2">
                            @foreach ($errors->all() as $error)
                                <x-alert type="danger" :message="$error" />
                            @endforeach
                        </div>
                    @endif
                    <form wire:submit.prevent="submit">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label class="form-label">Name</label>
                                <input type="text" wire:model.blur="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-12">
                                <label class="form-label">IP Address</label>
                                <input type="text" wire:model.blur="ip_address" class="form-control" placeholder="IP Address">
                            </div>
                            <div class="col-12">
                                <label class="form-label">OVpn User</label>
                                <input type="text" wire:model.blur="ovpn_user" class="form-control" placeholder="OVpn User">
                            </div>
                            <div class="col-12">
                                <label class="form-label">OVpn Password</label>
                                <input type="text" wire:model.blur="ovpn_password" class="form-control" placeholder="OVpn Password">
                            </div>
                            <div class="col-12">
                                <label class="form-label">WG Panel Address</label>
                                <input type="text" wire:model.blur="wg_panel_address" class="form-control" placeholder="WG Panel Address">
                            </div>
                            <div class="col-12">
                                <label class="form-label">WG Password</label>
                                <input type="text" wire:model.blur="wg_panel_password" class="form-control" placeholder="WG Password">
                            </div>
                            <div class="col-12">
                                <label class="form-label">OVpn Config</label>
                                <textarea name="ovpn_config" wire:model.blur="ovpn_config" class="form-control" cols="10" rows="2" placeholder="OVpn Config"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary-600">Update</button>
                        </div>
                    </form>
                </div>
            </div><!-- card end -->
        </div>
    </div>
</div>
