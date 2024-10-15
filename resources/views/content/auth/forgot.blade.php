@extends('layouts/fullLayoutMaster')

@section('title', 'locale.Forgot Password')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-basic px-2">
  <div class="auth-inner my-2">
    <!-- Forgot Password basic -->
    <div class="card mb-0 bg-primary text-white">
      <div class="card-body">
        <a href="#" class="brand-logo">
            <img src="{{ asset('images/logo/logo-light.svg') }}" width="200" alt="Logo">
        </a>
        <form class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}" method="POST">
            @csrf
          <div class="mb-1">
            <label for="forgot-password-email" class="form-label text-light">Email</label>
            <input
              type="email"
              class="form-control"
              id="forgot-password-email"
              name="email"
              value="{{ old('email') }}"
              placeholder="john@example.com"
              aria-describedby="forgot-password-email"
              tabindex="1"
              autofocus
            />
              @error('email')
                {{ $message  }}
              @enderror
          </div>
          <button class="btn btn-light w-100" tabindex="2">Send reset link</button>
        </form>

        <p class="text-center mt-2">
          <a href="{{ route('login') }}" class="text-white"> <i data-feather="chevron-left"></i> Back to login </a>
        </p>
      </div>
    </div>
    <!-- /Forgot Password basic -->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-forgot-password.js'))}}"></script>
@endsection
