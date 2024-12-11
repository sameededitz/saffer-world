@extends('layout.admin-guest')
@section('title')
    Email Verified | User
@endsection
@section('admin-guest')
    <section class="auth bg-base d-flex flex-wrap justify-content-center align-items-center">
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div class="card basic-data-table">
                    <div class="card-body py-80 px-32 text-center">
                        <img src="{{ asset('admin_assets/svg/verified.svg') }}" width="200px" alt="verify-img" class="mb-24">
                        <h6 class="mb-16">Email Verified Successfully</h6>
                        <p class="text-secondary-light">Now you can Login!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
