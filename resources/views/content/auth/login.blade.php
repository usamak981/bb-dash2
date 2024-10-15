    @extends('layouts/fullLayoutMaster')

    @section('title', 'locale.Login Page')

    @section('page-style')
        {{-- Page Css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
    @endsection

    @section('content')
        <div class="auth-wrapper auth-basic px-2">
            <div class="auth-inner my-2">
                <!-- Login basic -->
                <div class="card mb-0 text-white">
                    <div class="card-body">
                        <a href="#" class="brand-logo">
                            <img src="{{ asset('images/logo/logo-dark.png') }}" alt="Logo">
                        </a>
                        <p class="text-dark text-center" >Bitte geben Sie Ihre Email Adresse ein und fordern Sie einen SMS Code an.</p>

                        <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-1">
                                <label for="login-email" class="form-label text-dark">Email</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="login-email"
                                    name="email"
                                    placeholder="john@example.com"
                                    aria-describedby="login-email"
                                    value="{{ old('email') }}"
                                    tabindex="1"
                                    autofocus
                                />
                            </div>

                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label text-dark" for="login-password">Password</label>
                                    @if(Route::has('password.request'))
                                        <a class="text-light" href="{{ route('password.request') }}">
                                            <small>Forgot Password?</small>
                                        </a>
                                    @endif
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input
                                        type="password"
                                        class="form-control form-control-merge"
                                        id="login-password"
                                        name="password"
                                        tabindex="2"
                                        value="{{ old('password') }}"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="login-password"
                                    />
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                            <div class="mb-1 hidden">
                                <div class="form-check">
                                    <input class="form-check-input" name="remember" value="1" type="checkbox" id="remember-me" tabindex="3" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <button class="btn btn-primary w-100 mt-1" tabindex="4">Sign in</button>
                        </form>
                        @if(Route::has('register'))
                            <p class="text-center mt-2 text-dark">
                                <span>New on our platform?</span>
                                <a class="text-dark" href="{{ route('register') }}">
                                    <span>Create an account</span>
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
                <!-- /Login basic -->
            </div>
        </div>
    @endsection

    @section('vendor-script')
        <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
    @endsection

    @section('page-script')
        <script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
    @endsection
