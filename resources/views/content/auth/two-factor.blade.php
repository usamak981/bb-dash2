@extends('layouts/contentLayoutMaster')

@section('title', 'locale.Two Factor Authentication')

@section('content')
    <!-- Kick start -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Two Factor Authentication Option</h4>
        </div>
        <div class="card-body">
            <div class="card-text mb-2">You can enable / disable two factor authentication by clicking the button below.</div>
            <form action="{{ url('user/two-factor-authentication') }}" method="POST">
                @csrf
                @if(auth()->user()->two_factor_secret)
                    @method('DELETE')
                <div class="mb-2">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
                    <button type="submit" class="btn btn-danger">Disable</button>
                @else
                    <button type="submit" class="btn btn-primary">Enable</button>
                @endif
            </form>
        </div>
    </div>
    <!--/ Kick start -->

@endsection
