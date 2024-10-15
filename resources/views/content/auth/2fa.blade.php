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
            <div class="card mb-0 bg-primary text-white">
                <div class="card-body">
                    <a href="#" class="brand-logo">
                        <img width="200" src="{{ asset('images/logo/logo-light.svg') }}" alt="Logo">
                    </a>
                    @if ($message = session()->get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($message = session()->get('error'))
                        <div class="alert alert-danger alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <form class="auth-login-form mt-2" action="{{ route('2fa.store') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="login-email" class="form-label text-light">Code</label>
                            <input
                                type="number"
                                class="form-control"
                                id="code"
                                name="code"
                                placeholder="*****"
                                aria-describedby="login-code"
                                tabindex="1"
                                autofocus
                            />
                        </div>
                        @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror


                        <button class="btn btn-light w-100 mb-1" tabindex="4">Verify</button>
                        <div class="mb-1 right">
                            <a class="btn btn-link text-light text-nowrap" href="{{ route('2fa.resend') }}">Resend Code?</a>
                        </div>
                    </form>
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
