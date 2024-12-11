<div>
    @if ($errors->any())
        <div class="py-2">
            @foreach ($errors->all() as $error)
                <x-alert type="danger" :message="$error" />
            @endforeach
        </div>
    @endif
    <div class="py-2 success-text d-none alert alert-success fs-5">Password changed successfully!</div>
    <form wire:submit.prevent="update">
        <div class="row gy-3">
            <div class="col-12 position-relative">
                <label class="form-label">Old Password</label>
                <input type="password" wire:model.live="password" class="form-control" placeholder="Password"
                    id="your-password">
                <span
                    class="toggle-password ri-eye-line cursor-pointer position-absolute translate-middle-y me-16 text-secondary-light"
                    data-toggle="#your-password" style="top: 73%; right: 12px; font-size: 19px;"></span>
            </div>
            <div class="col-12 position-relative">
                <label class="form-label">New Password</label>
                <input type="password" wire:model.live="newpassword" class="form-control" placeholder="Password"
                    id="your-password-2">
                <span
                    class="toggle-password ri-eye-line cursor-pointer position-absolute translate-middle-y me-16 text-secondary-light"
                    data-toggle="#your-password-2" style="top: 73%; right: 12px; font-size: 19px;"></span>
            </div>
            <div class="col-12 position-relative mb-20">
                <label class="form-label">Confirm Password</label>
                <input type="password" wire:model.live="password_confirmation" class="form-control"
                    placeholder="Confirm Password" id="your-password-3">
                <span
                    class="toggle-password ri-eye-line cursor-pointer position-absolute translate-middle-y me-16 text-secondary-light"
                    data-toggle="#your-password-3" style="top: 73%; right: 12px; font-size: 19px;"></span>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary-600">Update</button>
        </div>
    </form>

    <script>
        window.addEventListener('passwordChanged', function() {
            // Show the success message
            document.querySelector('.success-text').classList.remove('d-none');

            // Close the Bootstrap modal after 2 seconds
            setTimeout(function() {
                var modal = bootstrap.Modal.getInstance(document.querySelector('#changePasswordModal'));
                modal.hide();
            }, 2000);
        });
    </script>
</div>
