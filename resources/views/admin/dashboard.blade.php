@extends('layout.admin-layout')

@section('admin_content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Dashboard</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">VPN</li>
        </ul>
    </div>

    @livewire('dashboard-stats')

    <div class="row gy-4 mt-1">
        <div class="col-xxl-12 col-xl-12">
            <div class="card basic-data-table">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">All Users</h5>
                </div>
                <div class="card-body scroll-sm" style="overflow-x: scroll">
                    @livewire('all-users')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('admin_scripts')
    <script>
        $('#myTable').DataTable({
            responsive: true
        });
    </script>
@endsection