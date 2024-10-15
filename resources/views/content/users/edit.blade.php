@extends('layouts/contentLayoutMaster')

@section('title', __('locale.Edit User'))

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('locale.Edit User Account')</h4>
                    </div>
                    <div class="card-body">
                        <form class="form form-unload-check" action="{{ route('users.update', $user->id) }}" method="post">
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
                                @if(auth()->id() != $user->id || !auth()->user()->hasRole(\App\Models\User::SUPER_ADMIN))
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="role-column">@lang('locale.Role')</label>
                                            <select
                                                type="text"
                                                id="role-column"
                                                class="form-control select2"
                                                name="role"
                                                required
                                            >
                                                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                                    @if($role->name !== \App\Models\User::SUPER_ADMIN)
                                                        <option {{ $user->hasRole($role->name) ? "selected" : "" }} value="{{ $role->name }}">{{ $role->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('role')
                                            <div class="font-small-2 text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
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
