@extends('layout.admin-guest')
@section('admin-guest')
    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-lg-block d-none">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="{{ asset('admin_assets/images/auth/auth-img.png') }}" width="90%" alt="">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                @if (session('status'))
                    <x-alert type="info" :message="session('status')" />
                @endif
                <div>
                    <a href="index.html" class="mb-40 max-w-290-px">
                        <img src="{{ asset('admin_assets/images/logo.png') }}" alt="">
                    </a>
                    <h4 class="mb-12">Sign In to your Account</h4>
                    <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
                </div>
                @if ($errors->any())
                    <div class="py-2">
                        @foreach ($errors->all() as $error)
                            <x-alert type="danger" :message="$error" />
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('login-user') }}" method="POST">
                    @csrf
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="text" name="email_or_username" value="{{ old('email_or_username') }}"
                            class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Email">
                    </div>
                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12"
                                id="your-password" placeholder="Password">
                        </div>
                        <span
                            class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                            data-toggle="#your-password"></span>
                    </div>
                    <div class="">
                        <div class="d-flex justify-content-between gap-2">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input border border-neutral-300" type="checkbox"
                                    value="{{ old('remember') }}" name="remember" id="remeber">
                                <label class="form-check-label" for="remeber">Remember me </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">
                        Sign
                        In</button>

                </form>
            </div>
        </div>
    </section>
@endsection
