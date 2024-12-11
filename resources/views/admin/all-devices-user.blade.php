@extends('layout.admin-layout')
@section('admin_content')
    @if (session('status'))
        <div class="row py-3">
            <div class="col-6">
                <x-alert :type="session('status', 'info')" :message="session('message', 'Operation completed successfully.')" />
            </div>
        </div>
    @endif

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0"></h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Users</li>
            <li>-</li>
            <li class="fw-medium">Devices</li>
        </ul>
    </div>

    <div class="card basic-data-table">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">All Devices of {{ $user->name }}</h5>
            @livewire('update-limit', ['user' => $user])
        </div>
        <div class="card-body scroll-sm" style="overflow-x: scroll">
            <table class="table display responsive bordered-table mb-0" id="myTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Device Id</th>
                        <th scope="col">IP Address</th>
                        <th scope="col">platform</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $device)
                        <tr>
                            <td><a href="javascript:void(0)" class="text-primary-600">{{ $loop->iteration }}</a></td>
                            <td>{{ $device->device_name }}</td>
                            <td>{{ $device->device_id }}</td>
                            <td>{{ $device->ip_address }}</td>
                            <td>{{ $device->platform }}</td>
                            <td>{{ $device->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <form action="{{ route('delete-device', $device->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('admin_scripts')
    <script>
        $('#myTable').DataTable({
            responsive: true
        });

        $('#switch3').on('change', function() {
            var streamId = $(this).data('stream');
            var status = $(this).is(':checked') ? 'active' : 'inactive';
            var url = "/admin/streams/" + streamId + "/status";

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    if (response.status == 'success') {
                        alert('Server status updated successfully');
                    } else {
                        console.error('Failed to update server status');
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });
    </script>
@endsection
