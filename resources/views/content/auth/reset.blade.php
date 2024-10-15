@extends('layouts/fullLayoutMaster')

@section('title', 'locale.Reset Password')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Reset Password basic -->
            <div class="card mb-0 bg-primary text-white">
                <div class="card-body">
                    <a href="#" class="brand-logo">
                        <img width="200" src="{{ asset('images/logo/logo-light.svg') }}" alt="Logo">
                    </a>
                    <form class="auth-reset-password-form mt-2" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->token }}">
                        <input type="hidden" name="email" value="{{ request()->email }}">
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label text-light" for="reset-password-new">New Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input
                                    type="password"
                                    class="form-control form-control-merge"
                                    id="reset-password-new"
                                    name="password"
                                    value="{{ old('password') }}"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="reset-password-new"
                                    tabindex="1"
                                    autofocus
                                />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                            @error('password')
                            {{ $message  }}
                            @enderror
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label text-light" for="reset-password-confirm">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input
                                    type="password"
                                    class="form-control form-control-merge"
                                    id="reset-password-confirm"
                                    name="password_confirmation"
                                    value="{{ old('password_confirmation') }}"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="reset-password-confirm"
                                    tabindex="2"
                                />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                            @error('password_confirmation')
                            {{ $message  }}
                            @enderror
                        </div>
                        <button class="btn btn-light w-100" tabindex="3">Set New Password</button>
                    </form>

                    <p class="text-center mt-2">
                        <a href="{{ route('login') }}" class="text-light"> <i data-feather="chevron-left"></i> Back to login </a>
                    </p>
                </div>
            </div>
            <!-- /Reset Password basic -->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
    <script src="{{asset(mix('js/scripts/pages/auth-reset-password.js'))}}"></script>
@endsection
