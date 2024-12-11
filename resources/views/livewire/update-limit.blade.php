<div>
    <button type="button" class="btn rounded-pill btn-outline-info-600 radius-8 px-20 py-11" data-bs-toggle="modal"
        data-bs-target="#changelimit">Update
        Limit</button>
    <div class="modal fade" id="changelimit" tabindex="-1" aria-labelledby="changelimit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">{{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="py-2">
                            @foreach ($errors->all() as $error)
                                <x-alert type="danger" :message="$error" />
                            @endforeach
                        </div>
                    @endif
                    <div class="py-2 success-msg d-none alert alert-success fs-5" id="success-msg">Password changed
                        successfully!</div>
                    <form wire:submit.prevent="update">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label class="form-label">Current Limit:
                                    {{ $user->device_limit ? $user->device_limit : 'not set' }}</label>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Limit</label>
                                <input type="number" wire:model="limit" class="form-control"
                                    placeholder="Enter Limit">
                                <small class="mt-6">Populate manually the count of devices in total for the customer.
                                    Will be applied
                                    lifetime. You can set Null too</small>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-600">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('updatedLimit', function() {
            // Show the success message
            document.getElementById('success-msg').classList.remove('d-none');

            // Close the Bootstrap modal after 2 seconds
            setTimeout(function() {
                var modal = bootstrap.Modal.getInstance(document.querySelector('#changelimit'));
                modal.hide();
            }, 1500);
        });
    </script>
</div>
