@extends('layouts/contentLayoutMaster')

@section('title', __('locale.Edit Reference'))

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')
    <section xmlns="http://www.w3.org/1999/html">
        <form class="form form-unload-check" id="ajaxForm" action="{{ route('references.update', $objekt->id) }}" enctype="multipart/form-data" method="post">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('locale.Edit Reference')</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="row bg-dark p-25 image-upload-div">
                                <div class="col-sm-9 p-25">
                                    <img class="image-upload-lg" src="{{ App\Helpers\Helpers::getImageSrc($objekt->images->where('order',0)->first()?->web_path) }}">
                                    <input type="file" accept="image/*" class="d-none" name="objekt_image[0]">
                                </div>
                                <div class="col-sm-3 p-25">
                                    <div class="mb-50">
                                        <img class="image-upload-sm" src="{{ App\Helpers\Helpers::getImageSrc($objekt->images->where('order',1)->first()?->web_path) }}">
                                        <input type="file" accept="image/*" class="d-none" name="objekt_image[1]">
                                    </div>
                                    <div class="mb-50">
                                        <img class="image-upload-sm" src="{{ App\Helpers\Helpers::getImageSrc($objekt->images->where('order',2)->first()?->web_path) }}">
                                        <input type="file" accept="image/*" class="d-none" name="objekt_image[2]">
                                    </div>
                                    <div class="mb-50">
                                        <img class="image-upload-sm" src="{{ App\Helpers\Helpers::getImageSrc($objekt->images->where('order',3)->first()?->web_path) }}">
                                        <input type="file" accept="image/*" class="d-none" name="objekt_image[3]">
                                    </div>
                                    <div>
                                        <img class="image-upload-sm" src="{{ App\Helpers\Helpers::getImageSrc($objekt->images->where('order',4)->first()?->web_path) }}">
                                        <input type="file" accept="image/*" class="d-none" name="objekt_image[4]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="name-column">@lang('locale.Objekt')</label>
                                        <input
                                            type="text"
                                            id="name-column"
                                            class="form-control"
                                            placeholder="@lang('locale.Objekt Name')"
                                            name="name"
                                            value="{{ old('name', $objekt->name) }}"
                                        />
                                        @error('name')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="website-column">@lang('locale.Website')</label>
                                        <input
                                            type="text"
                                            id="website-column"
                                            class="form-control"
                                            placeholder="@lang('locale.Website')"
                                            name="website"
                                            value="{{ old('website', $objekt->website) }}"
                                        />
                                        @error('website')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="mb-1 ">
                                        <label class="form-label d-block" >@lang('locale.Category')</label>
                                        @foreach($objektCategories as $code =>  $name)
                                            <div class="form-check form-check-inline">
                                                <input
                                                    {{ $loop->first && empty(old('category', $objekt->category)) ? "checked" : "" }}
                                                    {{ old("category", $objekt->category) == $code ? "checked" : "" }}
                                                    type="radio"
                                                    id="{{$name}}-cat-column"
                                                    class="form-check-input"
                                                    name="category"
                                                    value="{{$code}}"
                                                />
                                                <label class="form-check-label" for="{{$name}}-cat-column">@lang('locale.'.$name)</label>
                                            </div>
                                        @endforeach
                                        @error('category')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="street-column">@lang('locale.Street No')</label>
                                        <input
                                            type="text"
                                            id="street-column"
                                            class="form-control"
                                            placeholder="@lang('locale.Street No')"
                                            name="street"
                                            value="{{ old('street', $objekt->street) }}"
                                        />
                                        @error('street')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="location-column">@lang('locale.City')</label>
                                        <input
                                            type="text"
                                            id="location-column"
                                            class="form-control"
                                            placeholder="@lang('locale.City')"
                                            name="city"
                                            value="{{ old('city', $objekt->city) }}"
                                        />
                                        @error('city')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="postcode-column">@lang('locale.Postal Code')</label>
                                        <input
                                            type="text"
                                            id="postcode-column"
                                            class="form-control"
                                            placeholder="@lang('locale.Postal Code')"
                                            name="postal_code"
                                            value="{{ old('postal_code', $objekt->postal_code) }}"
                                        />
                                        @error('postal_code')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="country-column">@lang('locale.Country')</label>
                                        <select
                                            type="text"
                                            id="country-column"
                                            class="form-control select2"
                                            name="country"
                                        >
                                            @foreach($countries as $code => $country)
                                                <option {{ $code == old('country', $objekt->country_code) ? "selected" : "" }} value="{{ $code }}">@lang('countries.'.$country)</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="mb-1 ">
                                        <label class="form-label d-block" >@lang('locale.Objekttyp')</label>
                                        @foreach($objektTypeCodes as $code =>  $name)
                                            <div class="form-check form-check-inline">
                                                <input
                                                    {{ $loop->first && empty(old('objekt_type_code', $objekt->objekt_type_code)) ? "checked" : "" }}
                                                    {{ old("objekt_type_code", $objekt->objekt_type_code) == $code ? "checked" : "" }}
                                                    type="radio"
                                                    id="{{$name}}-column"
                                                    class="form-check-input"
                                                    name="objekt_type_code"
                                                    value="{{$code}}"
                                                />
                                                <label class="form-check-label" for="{{$name}}-column">@lang('locale.'.$name)</label>
                                            </div>
                                        @endforeach
                                        @error('objekt_type_code')
                                        <div class="font-small-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="mb-1 mt-2 pt-50">
                                <label class="form-label" for="note-column">@lang('locale.Internal notes (not visible)')</label>
                                <textarea
                                    id="note-column"
                                    class="form-control"
                                    placeholder="@lang('locale.Internal notes (not visible)')"
                                    name="note"
                                >{{ old('note', $objekt->note) }}</textarea>
                                @error('note')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="mb-1">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link disabled" type="button">@lang('locale.Beschreibung')</button>
                                        <button class="nav-link active" id="nav-german-tab" data-bs-toggle="tab" data-bs-target="#nav-german" type="button" role="tab" aria-controls="nav-german" aria-selected="true">@lang('locale.German')</button>
                                        <button class="nav-link" id="nav-english-tab" data-bs-toggle="tab" data-bs-target="#nav-english" type="button" role="tab" aria-controls="nav-english" aria-selected="false">@lang('locale.English')</button>
                                        <button class="nav-link" id="nav-french-tab" data-bs-toggle="tab" data-bs-target="#nav-french" type="button" role="tab" aria-controls="nav-french" aria-selected="false">@lang('locale.French')</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-german" role="tabpanel" aria-labelledby="nav-german-tab">
                                                <textarea
                                                    type="text"
                                                    id="du-description-column"
                                                    class="form-control"
                                                    placeholder="@lang('locale.German Description')"
                                                    name="de_description"
                                                >{{ old('de_description', $objekt->de_description) }}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="nav-english" role="tabpanel" aria-labelledby="nav-english-tab">
                                                <textarea
                                                    type="text"
                                                    id="en-description-column"
                                                    class="form-control"
                                                    placeholder="@lang('locale.English Description')"
                                                    name="en_description"
                                                >{{ old('en_description', $objekt->en_description) }}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="nav-french" role="tabpanel" aria-labelledby="nav-french-tab">
                                                <textarea
                                                    type="text"
                                                    id="fr-description-column"
                                                    class="form-control"
                                                    placeholder="@lang('locale.French Description')"
                                                    name="fr_description"
                                                >{{ old('fr_description', $objekt->fr_description) }}</textarea>
                                    </div>
                                </div>
                                @error('de_description')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                                @error('en_description')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                                @error('fr_description')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-2 pt-lg-2 text-lg-start text-end">
                            <button type="submit" class="btn btn-primary mt-lg-5 me-1">@lang('locale.Update')</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center fle~x-wrap justify-content-between border-bottom-secondary py-2 mb-2">
                <h4>@lang('locale.Projects') </h4>
                <div class="d-flex align-items-center align-content-center"><a href="#" id="addProject" class="text-black d-flex align-items-center">@lang('locale.Add Project') &nbsp;<i class="fa fa-2x fa-plus-circle"></i></a></div>
            </div>
            <div id="projekts-div">
                @foreach($objekt->projekts as $projekt)
                    <x-references.projekt
                        :projektCompetenceTypes="$projektCompetenceTypes"
                        :projektConstructionTypes="$projektConstructionTypes"
                        :projektMaterialTypes="$projektMaterialTypes"
                        :projektTypes="$projektTypes"
                        :projekt="$projekt"
                    />
                @endforeach
            </div>
        </form>
        @include('content.references.single_projekt')
    </section>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
