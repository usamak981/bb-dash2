@extends('layouts/fullLayoutMaster')

@section('title', 'locale.Register Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Register basic -->
            <div class="card mb-0 bg-primary text-light">
                <div class="card-body">
                    <a href="#" class="brand-logo">
                        <img width="200" src="{{ asset('images/logo/logo-light.svg') }}" alt="Logo">
                    </a>

                    <form class="auth-register-form mt-2" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="register-username" class="form-label text-light">First Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="register-first-name"
                                name="first_name"
                                placeholder="johndoe"
                                aria-describedby="register-first-name"
                                tabindex="1"
                                autofocus
                            />
                        </div>
                        <div class="mb-1">
                            <label for="register-username" class="form-label text-light">Last Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="register-lastname"
                                name="last_name"
                                placeholder="johndoe"
                                aria-describedby="register-last-name"
                                tabindex="2"
                                autofocus
                            />
                        </div>
                        <div class="mb-1">
                            <label for="register-password" class="form-label text-light">Phone</label>

                            <div class="input-group input-group-merge form-password-toggle">
                                <input
                                    type="text"
                                    class="form-control form-control-merge"
                                    id="register-phone"
                                    name="phone"
                                    placeholder="Phone"
                                    aria-describedby="register-phone"
                                    tabindex="3"
                                />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="register-email" class="form-label text-light">Email</label>
                            <input
                                type="text"
                                class="form-control"
                                id="register-email"
                                name="email"
                                placeholder="john@example.com"
                                aria-describedby="register-email"
                                tabindex="4"
                            />
                        </div>

                        <div class="mb-1">
                            <label for="register-password" class="form-label text-light">Password</label>

                            <div class="input-group input-group-merge form-password-toggle">
                                <input
                                    type="password"
                                    class="form-control form-control-merge"
                                    id="register-password"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="register-password"
                                    tabindex="5"
                                />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="register-password" class="form-label text-light">Confirm Password</label>

                            <div class="input-group input-group-merge form-password-toggle">
                                <input
                                    type="password"
                                    class="form-control form-control-merge"
                                    id="register-password"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="register-password"
                                    tabindex="6"
                                />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="register-privacy-policy" tabindex="4" />
                                <label class="form-check-label" for="register-privacy-policy">
                                    I agree to <a href="#">privacy policy & terms</a>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-light w-100" tabindex="5">Sign up</button>
                    </form>

                    <p class="text-center mt-2">
                        <span>Already have an account?</span>
                        <a class="text-light" href="{{ route('login') }}">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register basic -->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('js/scripts/pages/auth-register.js')}}"></script>
@endsection
