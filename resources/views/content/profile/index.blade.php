@extends('layouts/contentLayoutMaster')

@section('title', __('locale.Edit Profile'))

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('locale.Edit Account')</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('profile.update') }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-column">@lang('locale.First Name')</label>
                                        <input
                                            type="text"
                                            id="first-name-column"
                                            class="form-control"
                                            placeholder="@lang('locale.First Name')"
                                            name="first_name"
                                            required
                                            value="{{ old('first_name', $user->first_name) }}"
                                        />
                                        @error('first_name')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="last-name-column">@lang('locale.Last Name')</label>
                                        <input
                                            type="text"
                                            id="last-name-column"
                                            class="form-control"
                                            placeholder="@lang('locale.Last Name')"
                                            name="last_name"
                                            required
                                            value="{{ old('last_name', $user->last_name) }}"
                                        />
                                        @error('last_name')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="phone-column">@lang('locale.Phone')</label>
                                        <input
                                            required
                                            type="text"
                                            id="phone-column"
                                            class="form-control"
                                            placeholder="@lang('locale.Phone')"
                                            name="phone"
                                            value="{{ old('phone', $user->phone) }}"
                                        />
                                        @error('phone')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="email-column">@lang('locale.Email Address')</label>
                                        <input
                                            type="email"
                                            id="email-column"
                                            class="form-control"
                                            placeholder="@lang('locale.Email Address')"
                                            name="email"
                                            required
                                            value="{{ old('email', $user->email) }}"
                                        />
                                        @error('email')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1">@lang('locale.Save')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
