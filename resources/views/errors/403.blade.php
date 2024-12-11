@extends('layout.admin-guest')
@section('title')
    403 | Page Expired
@endsection
@section('admin-guest')
    <section class="auth bg-base d-flex flex-wrap justify-content-center align-items-center">
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div class="card basic-data-table">
                    <div class="card-body py-80 px-32 text-center">
                        <img src="{{ asset('admin_assets/svg/403.svg') }}" width="200px" alt="error-img" class="mb-24">
                        <h6 class="mb-16">Page Expired</h6>
                        <p class="text-secondary-light">Sorry, the link you clicked has an invalid signature or has expired.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary-600 radius-8 px-20 py-11">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
