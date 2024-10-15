@extends('layouts/contentLayoutMaster')

@section('title', __('locale.Reset Password'))

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('locale.locale.User'): {{ $user->full_name }} <span class="text-muted">({{ $user->email }})</span></h4>
                    </div>
                    <div class="card-body">
                        <form class="form mt-1" action="{{ route('users.update.password', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="password-column">@lang('locale.New Password')</label>
                                        <input
                                            required
                                            type="password"
                                            id="password-column"
                                            class="form-control"
                                            placeholder="@lang('locale.New Password')"
                                            name="password"
                                            value="{{ old('password') }}"
                                        />
                                        @error('password')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="password_confirmation-column">@lang('locale.Confirm Password')</label>
                                        <input
                                            required
                                            type="password"
                                            id="password_confirmation-column"
                                            class="form-control"
                                            placeholder="@lang('locale.Confirm Password')"
                                            name="password_confirmation"
                                            value="{{ old('password_confirmation') }}"
                                        />
                                        @error('password_confirmation')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1">@lang('locale.Save')</button>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">@lang('locale.Cancel')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
