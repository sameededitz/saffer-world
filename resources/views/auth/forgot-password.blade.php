@extends('layout.admin-guest')
@section('admin-guest')
    <section class="auth bg-base d-flex flex-wrap justify-content-center align-items-center">
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <h4 class="mb-12">Forgot Password</h4>
                    <p class="mb-16 text-secondary-light text-lg">
                        {{ __('Enter the email address associated with your account and we will send you a link to reset your password.') }}
                    </p>
                    @if (session('status'))
                        <p class="mb-32 text-secondary-light text-lg">{{ session('status') }}</p>
                    @endif
                </div>
                @if ($errors->any())
                    <div class="py-2">
                        @foreach ($errors->all() as $error)
                            <x-alert type="danger" :message="$error" />
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12"
                            placeholder="Enter Email">
                    </div>
                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Continue</button>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-primary-600 fw-bold mt-24">Back to Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
