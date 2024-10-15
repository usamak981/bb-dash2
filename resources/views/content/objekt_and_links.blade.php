@extends('layouts.frontendLayoutMaster')
@section('title', $objekt->name)
@section('content')
    <section class="container">
        <div class="col-12 col-md-10 col-lg-8 col-xl-5 p-0 mt-5 pt-5">
            <div class="banner-heading calibri d-flex align-items-end" style="line-height: 45px">{{ $objekt->name }}</div>
            <p class="tx-mediumblue calibri mt-2 mb-3" style="font-size: 18px;" >{{ $objekt->street }}, {{ $objekt->postal_code }}, {{ $objekt->city }}, {{ $objekt->country?->name }}</p>
            <div>
                <form class="d-flex">
                    @if(!empty($objekt->category))
                        <a class="btn bg-mediumblue px-3 py-1 text-white border-0 calibri me-4">{{ @$categories[$objekt->category] }}</a>
                    @endif
                    @if(!empty($objekt->objekt_type_code))
                        <a class="btn bg-mediumblue px-3 py-1 text-white border-0 calibri">{{ @$objektTypes[$objekt->objekt_type_code] }}</a>
                    @endif
                </form>
            </div>
        </div>
        <div class="row mt-5 pt-4">
            <div class="col-12 col-md-12 col-lg-9">
                <div class="row px-0 mx-auto d-inline-flex justify-content-center">
                    <div class="col-12 col-md-4 col-lg-2 col-lx-2 row text-center d-inline-flex flex-row flex-lg-column pe-0 align-items-center justify-content-md-between">

                        @if($objekt->images->count() > 1)
                            @foreach($objekt->images as $img)
                                @if ($loop->first)
                                    @continue
                                @endif
                                <img
                                    class="col-6 col-md-12 ps-0 mb-md-0 small-img pointer"
                                    width="145"
                                    alt="{{ $img->description }}"
                                    src="{{ App\Helpers\Helpers::getImageSrc($img->web_path) }}" />
                            @endforeach
                        @else
                            @for($i = 0; $i < 4; $i++)
                                <img
                                    class="col-6 col-md-12 ps-0 mb-2 mb-md-0 small-img pointer"
                                    width="145"
                                    src="{{ asset('images/default/no-preview-available.png') }}" alt="{{ $objekt->name }}"/>
                            @endfor
                        @endif
                    </div>
                    <div class="col-12 col-md-8 col-lg-10 col-xl-10 align-items-center">
                        @if($objekt->images->count())
                            <img src="{{ App\Helpers\Helpers::getImageSrc($objekt->images->first()?->web_path) }}" alt="{{ $objekt->images->first()?->description }}"
                                 class="d-flex flex-fill big-img small-img"
                                 width="100%"
                                 height="528"
                            />
                        @else
                            <img src="{{ asset('images/default/no-preview-available.png') }}" alt="{{ $objekt->name }}"
                                 class="d-flex flex-fill big-img small-img"
                                 width="100%"
                                 height="528"
                            />
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 mt-3 mt-lg-0">
                <p class="text-uppercase tx-grey calibribold mb-2" >@lang('locale.AUFTRAGGEBER')</p>
                <h4 class="text-capitalize tx-mediumblue calibribold mt-0 line-height-38" >{{ $objekt->name }}</h4>
                <p class="text-uppercase tx-grey calibribold mt-4 pt-2 mb-2" >@lang('locale.LEISTUNGSKOMPETENZ')</p>
                <h4 class="text-capitalize tx-mediumblue calibribold mt-0 line-height-38">
                    @foreach($objekt->projekts->take(4)->pluck('competence') as $competence)
                        {{ @$competences[$competence] }}@if(!$loop->last), @elseif($objekt->projekts->count() > 4),... @endif
                    @endforeach

                </h4>
                <p class="text-uppercase tx-grey calibribold mt-4 pt-2 mb-2" >@lang('locale.FERTIGSTELLUNGSJAHR')</p>
                <h4 class="text-capitalize tx-mediumblue calibribold mt-0 line-height-38" >{{ $objekt->projekts->max('end_year') }}</h4>
                <p class="text-uppercase tx-grey calibribold mt-4 pt-2 mb-2" >@lang('locale.BAUZEIT')</p>
                <h4 class="text-capitalize tx-mediumblue calibribold mt-0 line-height-38" >{{ $duration }} @lang('locale.Months')</h4>
                <p class="text-uppercase tx-grey calibribold mt-4 pt-2 mb-2" >@lang('locale.GESAMTWASSERFLÄCHE')</p>
                <h4 class="tx-mediumblue calibribold mt-0 line-height-38" >{{ $objekt->total_water_surface }} m²</h4>
            </div>
        </div>
        <div class="row mt-5 mb-3">
            <p class="col-12 col-lg-7 calibri ps-3 ps-lg-2 text-justify" style="text-align: justify" >
                @if(config('app.locale') == 'fr')
                    {{ $objekt->fr_description }}
                @elseif(config('app.locale') == 'de')
                    {{ $objekt->de_description }}
                @else
                    {{ $objekt->en_description }}
                @endif
            </p>
        </div>
    </section>


    <section class="bg-container-fluid pb-4" style="margin-top: 70px">
        <div class="container">
            <div class="row mb-5 pb-5">
                <div class="col-11 col-md-6 col-lg-4 ms-3 ms-lg-2 grey-border">
                    <p class="text-uppercase tx-grey calibribold mb-2 mt-4" >@lang('locale.Beckenarten')</p>
                    @foreach($objekt->projekts as $projekt)
                        <h4 class="text-capitalize tx-mediumblue calibribold mt-0 line-height-38">@lang('locale.' . $projekt->project_type?->name)</h4>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg d-flex align-items-end">
            <div class="modal-content bg-transparent border-0 d-flex align-items-end" style="width: 750px; height: 600px; object-fit: contain ">
                <div class="modal-header border-0 p-0">
                    <button type="button" class="btn p-0 btn-link closeImageModal close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('images/close.svg') }}" width="30">
                    </button>
                </div>
                <div class="modal-body p-0 d-flex align-items-center">
                    <button type="button" class="close bg-transparent border-0 position-absolute" style="top: 35px; right: -13px" data-dismiss="modal">
                        <i class="fa-regular fa-2x fa-circle-xmark text-white"></i>
                    </button>
                    <img src="" class="imagepreview" style="width: 100%;" >
                </div>
            </div>
        </div>
    </div>
@endsection
