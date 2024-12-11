@extends('layout.admin-guest')
@section('admin-guest')
    <section class="auth bg-base d-flex flex-wrap justify-content-center align-items-center">
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <h4 class="mb-12">Verify Email</h4>
                    <p class="mb-16 text-secondary-light text-lg">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </p>
                    @if (session('status'))
                        <p class="mb-32 text-secondary-light text-lg">{{ session('status') }}</p>
                    @endif
                </div>
                <form action="{{ route('verification.send') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">Resend</button>
                </form>
                <div class="text-center">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-primary-600 fw-bold mt-24">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
