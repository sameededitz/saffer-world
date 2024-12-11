<div class="alert alert-{{ $type }} bg-{{ $type }}-100 text-{{ $type }}-600 border-{{ $type }}-100 px-24 py-11 mb-3 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between"
    role="alert">
    <div class="d-flex align-items-center gap-2">
        {{ $message }}
    </div>
    <button class="remove-button text-{{ $type }}-600 text-xxl line-height-1">
        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
    </button>
</div>
