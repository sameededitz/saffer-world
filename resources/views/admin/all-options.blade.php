@extends('layout.admin-layout')
@section('title')
    Options | Admin
@endsection
@section('admin_content')
    @if (session('status'))
        <div class="row py-3">
            <div class="col-6">
                <x-alert :type="session('status', 'info')" :message="session('message', 'Operation completed successfully.')" />
            </div>
        </div>
    @endif
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Options</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('admin-home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Options</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Set Settings</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="py-2">
                            @foreach ($errors->all() as $error)
                                <x-alert type="danger" :message="$error" />
                            @endforeach
                        </div>
                    @endif
                    <form id="contentForm" action="{{ route('save-options') }}" method="POST">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-12">
                                <label class="form-label" for="privacy_policy">Privacy Policy</label>
                                <textarea name="privacy_policy" id="privacy_policy" class="form-control tinymce-editor">{{ $privacyPolicyContent }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="terms_of_service">Terms of Service</label>
                                <textarea id="tosEditor" name="tos" class="form-control tinymce-editor">{{ $tosContent }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary-600">Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
@section('admin_scripts')
    <script src="https://cdn.tiny.cloud/1/profov2dlbtwaoggjfvbncp77rnjhgyfnl3c2hx3kzpmhif1/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.tinymce-editor',
            setup: function(editor) {
                editor.on('blur', function() {
                    editor.save(); // Automatically save content to the textarea when focus is lost
                });
            }
        });

        document.getElementById('contentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            tinymce.triggerSave(); // Save the content of all TinyMCE editors to their respective textareas
            form.submit(); // Now submit the form
        });
    </script>
@endsection
