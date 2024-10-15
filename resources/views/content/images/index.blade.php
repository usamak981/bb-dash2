@extends('layouts/contentLayoutMaster')

@section('title', __('locale.Images'))

@section('content')
    <!-- users list start -->
    <section class="app-user-list">
        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl d-flex align-items-end justify-content-center">
                <div class="modal-content border-0 d-flex align-items-end rounded-0" style="object-fit: contain ">
                    <form class="imageForm" method="post" data-action="{{ route('pictures.index') }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body d-flex align-items-center">
                            <button type="button" class="close bg-transparent border-0 position-absolute" style="top: 35px; right: -13px" data-dismiss="modal">
                                <i class="fa-regular fa-2x fa-circle-xmark text-white"></i>
                            </button>
                            <div class="row d-felx justify-content-center">
                                <div class="col-12 col-lg-5 p-0">
                                    <img src="" class="imagepreview" style="width: 100%; height: 360px" >
                                </div>
                                <div class="col-12 col-lg-7 row mt-2 mt-lg-0">
                                    <div class="col-5">
                                        <p style="font-size: 24px; padding-top: 9px" class="calibribold text-black">ID: <span class="imageID"></span></p>
                                    </div>
                                    <div class="col-6 col-md-3 px-0">
                                        <a style="padding-bottom: 9px; padding-top: 9px" target="_blank" class="imageViewBtn bg-mediumblue w-100 mx-auto text-white border-0 calibribold d-flex align-items-center justify-content-center">
                                            <h5 class="text-white d-inline mb-0">@lang('locale.View Image')</h5></a>
                                    </div>
                                    <div class="col-12">
                                        <label class="calibri text-black h5 fw-normal" for="img_description">@lang('locale.Image Description')</label>
                                        <div class="input-group p-0">
                                            <input type="text" name="description" id="img_description" class="imageDescription form-control rounded-0 dark-placeholder" placeholder="Strandbad Baden" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-6 mt-1">
                                        <label class="calibri text-black h5 fw-normal" for="img_description">@lang('locale.Objekttyp')
                                            <img data-toggle="tooltip" data-placement="top" title="@lang('locale.Objekttyp')" src="{{ asset("images/svg/info.svg") }}" />
                                        </label>
                                        <div class="input-group">
                                            <select class="imageObjketType form-select dark-dropdown-icon rounded-0 text-black" disabled>
                                                @foreach($objektTypes as $code => $obj)
                                                    <option value="{{ $code }}">{{ $obj }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-1">
                                        <label class="calibri text-black h5 fw-normal" for="img_description">@lang('locale.Projektart')
                                            <img data-toggle="tooltip" data-placement="top" title="@lang('locale.Projektart')" src="{{ asset("images/svg/info.svg") }}" />
                                        </label>
                                        <div class="input-group">
                                            <select class="imageProjketType form-select dark-dropdown-icon rounded-0 text-black" disabled>
                                                <option value=""></option>
                                                @foreach($projektTypes as $code => $proj)
                                                    <option value="{{ $code }}">{{ $proj }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-1">
                                        <label class="calibri text-black h5 fw-normal" for="img_description">@lang('locale.Copyright')
                                            <img data-toggle="tooltip" data-placement="top" title="@lang('locale.Copyright')" src="{{ asset("images/svg/info.svg") }}" />
                                        </label>
                                        <div class="input-group">
                                            <input type="text" name="copyright" placeholder="@lang('locale.Name des Fotografen')" class="imageCopyright form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 row d-flex align-items-center justify-content-end mt-2">
                                        <div class="col-2">

                                            <a href="#" title="@lang('locale.Delete Image')" class="imageDelBtn action-btn text-danger del-btn">
                                                <img src="{{ asset("images/svg/trash.svg") }}" />
                                            </a>
                                        </div>
                                        <div class="col-7 col-md-3 col-lg-4 col-xl-3 px-0">
                                            <button style="padding-bottom: 9px; padding-top: 9px" class="shadow-lg bg-mediumblue w-100 mx-auto text-white border-0 calibribold d-flex align-items-center justify-content-center" type="submit">
                                                <h5 class="text-white d-inline mb-0"> Save </h5></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="post" class="imageDelForm delete-btn-form d-inline">
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="card rounded-0 border-1 shadow-none">
            <div class="card-header d-none">
                <h4 class="card-title"></h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pictures.index') }}" method="get">
                    <div class="row px-1 pt-3 pb-2">
                        <div class="col-12 col-md-4 col-lg-3 col-xl">
                            <input type="search" value="{{ request('search') }}" name="search" class="form-control rounded-0" placeholder="@lang('locale.Search')" aria-label="Search">
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl mt-2 mt-md-0">
                            <select name="category" class="form-select rounded-0 select2">
                                <option value="all" hidden>@lang('locale.All Categories')</option>
                                @foreach($categories as $code => $name)
                                    <option {{ request('category') == $code ? "selected" : "" }} value="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl mt-2 mt-md-0">
                            <select name="country" class="form-select rounded-0 select2">
                                <option value="all" hidden>@lang('locale.All Countries')</option>
                                @foreach($countries as $code => $country)
                                    <option {{ request('country') == $code ? "selected" : "" }} value="{{ $code }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl mt-2 mt-lg-0">
                            <select name="objekt_type" class="form-select  rounded-0 select2">
                                <option value="all" hidden>@lang('locale.All Object Types')</option>
                                @foreach($objektTypes as $code => $obj)
                                    <option {{ request('objekt_type') == $code ? "selected" : "" }} value="{{ $code }}">{{ $obj }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                            <button style="padding-bottom: 9px; padding-top: 9px " class="btn btn-primary w-100 mx-auto mt-2 mt-xl-0 text-white border-0 calibribold d-flex align-items-center justify-content-center" type="submit">
                                {{-- <img src={{ "pictures/svg/add_white.svg" }} class="me-1" width="20px" height="20px" /> --}}
                                <h5 class="text-white d-inline mb-0"> Search </h5></button>
                        </div>
                    </div>
                </form>
                <hr class="mb-0" />
                <div class="row mb-2">
                    @if($images->count() > 0)
                        @foreach($images as $img)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-4 px-2">
                                <img class="cursor-pointer rounded-0 card-img search-img"
                                     data-description="{!! $img->description !!}"
                                     data-copyright="{!! $img->copyright !!}"
                                     data-objekt-type="{{ $img->objekt->objekt_type_code }}"
                                     data-projekt-type="{{ $img->projekt?->projekt_type_code }}"
                                     data-id="{{ $img->id }}"
                                     src="{{ App\Helpers\Helpers::getImageSrc($img->orig_path) }}" />
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 my-5">
                            <h3 class="text-center text-muted">@lang('locale.No Image Found')</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{ $images->withQueryString()->links() }}
@endsection

