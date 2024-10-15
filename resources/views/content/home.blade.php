@extends('layouts.frontendLayoutMaster')
@section('title','locale.Home Page')
@section('content')
    <div class="">
        <section class="container-fluid bg-lightblue">
            <div class="text-center row d-flex justify-content-center banner-height">
                <div class="col-12 col-md-6 col-lg-4 p-0 mt-5 pt-5">
                    <h1 class="banner-heading calibri">@lang('locale.References')</h1>
                    <p class="calibribold tx-grey mt-3">@lang('locale.Front Page Text')</p>
                </div>
            </div>
        </section>
        <section class="container-lg">
            <div class="row map-container position-relative d-flex justify-content-end" style="top: -300px">
                <section class="col-12 col-lg-8 p-0 position-relative">
                    <div id="map" class="mx-auto shadow-lg" style="width:92%;height:730px;"></div>
                </section>

                <section class="col-12 col-md-9 row col-lg-5 mx-auto form d-lg-flex align-items-center justify-content-center justify-content-lg-start" style="height:730px; z-index: 999">
                    <form class="row col-12 col-md-10 col-lg-12 m-0 bg-white p-4 shadow-lg" action="{{ url('/') }}" method="get">
                        <div class="col-6 pt-4 pe-2">
                            <label for="country" class="calibri pb-2 text-black text-capitalize">land</label>
                            <div class="input-group mb-3 shadow-none">
                                <select class="form-select select2 form-select-6 shadow-none input-border py-3 ps-3" name="country" id="country">
                                    <option value="" selected>@lang('locale.Land auswählen')</option>
                                    @foreach($countries as $code => $country)
                                        <option {{ $code == old('country', request('country')) ? "selected" : "" }} value="{{ $code }}">@lang('countries.'.$country)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6 pt-4 ps-2">
                            <label for="postal_code_city" class="calibri pb-2 text-black text-capitalize">@lang('locale.Stadt/PLZ')</label>
                            <div class="input-group mb-3 shadow-none">
                                <input type="text" name="postal_code_city" value="{{ old('postal_code_city', request('postal_code_city')) }}" class="input-group mb-3 shadow-none form-select-6 input-border py-3 ps-3" placeholder="@lang('locale.Stadt/PLZ')" id="postal_code_city" />
                            </div>
                        </div>
                        <div  class="calibri pb-2 text-black text-capitalize">@lang('locale.Fertigstellungsjahr')</div>
                        <div class="col-6 pe-2 position-relative">
                            <input type="text" name="start_date" value="{{ old('start_date', request('start_date')) }}" class="input-group date-picker mb-3 shadow-none form-select-6 input-border py-3 ps-3" placeholder="@lang('locale.From')" id="inputGroupSelect01" />
                            <span class="date-clear fa fa-times"></span>
                            @error('start_date')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 ps-2  position-relative">
                            <input type="text" name="end_date" value="{{ old('end_date', request('end_date')) }}" class="input-group date-picker mb-3 shadow-none form-select-6 input-border py-3 ps-3" placeholder="@lang('locale.To')" id="inputGroupSelect01" />
                            <span class="date-clear fa fa-times cursor-pointer"></span>
                            @error('end_date')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 pe-2">
                            <label for="objekt_type_code" class="calibri pb-2 text-black text-capitalize">@lang('locale.Typ')</label>
                            <div class="input-group mb-3 shadow-none">
                                <select class="form-select form-select-12 shadow-none input-border py-3 ps-3" name="objekt_type_code" id="objekt_type_code">
                                    <option value="" selected>@lang('locale.Typ auswählen')</option>
                                    @foreach($objektTypeCodes as $code => $objektName)
                                        <option {{ $code == old('objekt_type_code', request('objekt_type_code')) ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$objektName)</option>
                                    @endforeach
                                </select>
                                @error('objekt_type_code')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 pe-2">
                                <label for="construction" class="calibri pb-2 text-black text-capitalize">@lang('locale.Bauart')</label>
                            <div class="input-group mb-3 shadow-none">
                                <select class="form-select form-select-6 select2 shadow-none input-border py-3 ps-3" name="construction" id="construction">
                                    <option value="" selected>@lang('locale.Bauart wählen')</option>
                                    @foreach($projektConstructionTypes as $code => $projektConstructionType)
                                        <option {{ $code == old('construction', request('construction')) ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$projektConstructionType)</option>
                                    @endforeach
                                </select>
                                @error('construction')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 ps-2">
                            <label for="competence" class="calibri pb-2 text-black text-capitalize">@lang('locale.Leistungskompetenz')</label>
                            <div class="input-group mb-3 shadow-none">
                                <select class="form-select shadow-none form-select-6 input-border py-3 ps-3" name="competence" id="inputGroupSelect01">
                                    <option value="" selected>@lang('locale.Leistungskompetenz')</option>
                                    @foreach($projektCompetenceTypes as $code => $projektCompetenceTypeName)
                                        <option {{ $code == old('competence', request('competence')) ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$projektCompetenceTypeName)</option>
                                    @endforeach
                                </select>
                                @error('competence')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex my-4 pt-1 pb-4">
                            <button class="bg-mediumblue w-100 mx-auto py-4 text-white border-0 calibribold" type="submit">Filter anwenden</button>
                        </div>
                    </form>
                </section>
            </div>
        </section>
        <section class="container-lg">
            <div class="d-flex justify-content-center row pagination-wrapper position-relative"  style="top: -170px">
                @foreach($references as $ref)
                    <div class="col-12 col-md-5 col-lg-4 content page-content pb-5"  id="page-content" >
                        <a href="{{ route('objekts', $ref->id) }}" class="text-dark text-decoration-none">
                            <div class="position-relative card-img-container">
                                @if($ref->images->count())
                                    <img loading="lazy" src="{{ App\Helpers\Helpers::getImageSrc($ref->images->first()->web_path) }}" alt="{{ $ref->images->first()->description }}" class="position-relative card-img" />
                                @else
                                    <img loading="lazy" src="{{ asset('images/default/no-preview-available.png') }}" alt="{{ $ref->name }}" class="position-relative card-img" />
                                @endif
                                <form class="card-button" >
                                    <button class="bg-mediumblue text-decoration-none px-3 py-2 text-white border-0 calibribold">{{ $ref->projekts->max('end_year') }}</button>
                                </form>
                            </div>
                            <p class="calibribold text-dark mb-1 mt-3 ps-3 ps-md-0" style="font-size: 25px">{{ $ref->name }}</p>
                            <p class="calibri tx-grey ps-3 ps-md-0">@if($ref->country) @lang('countries.'.$ref->country->name) @endif</p>
                        </a>
                    </div>
                @endforeach

                {!! $references->links('vendor.pagination.simple-bootstrap-5') !!}

            </div>
        </section>
    </div>
    <script>
        let locations = @json($locations)
    </script>
@endsection
