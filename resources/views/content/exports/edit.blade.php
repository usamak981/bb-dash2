@extends('layouts/contentLayoutMaster')

@section('title', __('locale.Edit Data Export'))

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <div class="row">
        {{-- <aside> --}}
        <aside class="col-12 col-lg-5">
            <form class="form  form-unload-check" action="{{ route('exports.update',$export->id) }}" method="post" id="export_filter_form" >
                <div class="card rounded-0 border-1 shadow-none">
                    <div class="card-header d-none">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body mx-1">
                        @csrf
                        @method('PUT')
                        <div class="row my-2 pt-1">
                            <div class="col-12">
                                <div class="input-group ">
                <span class="input-group-text bg-white rounded-0 border-end-0 py-1" id="basic-addon1">
                  <img src={{ asset("images/svg/search.svg") }} />
                </span>
                                    <input type="search" value="{{ old('search', $export->search) }}" name="search" id="search" class="form-control rounded-0 border-start-0" placeholder="@lang('locale.Search')" aria-label="Search" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-5 col-md-4 col-xl-3 mt-2 pt-1">
                                <select class="form-select  rounded-0 select2" name="start_year" id="start_year">
                                    @for($i=1990;$i<=date('Y');$i++)
                                        <option {{ $i == old('start_year',$export->start_year) ? "selected" : "" }} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-2 col-md-1 p-0 pt-2 d-flex align-items-end justify-content-center">
                                <p class="text-black fw-bold">@lang('locale.bis')</p></div>
                            <div class="col-5 col-md-4 col-xl-3 mt-2 pt-1">
                                <select class="form-select rounded-0 select2" name="end_year" id="end_year">
                                    @for($i = 1990; $i <= date('Y') + 10; $i++)
                                        <option {{ $i == old('start_year',$export->end_year) ? "selected" : "" }} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12">
                                @error('start_year')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                                @error('end_year')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-7 mt-2 pt-1">
                                <select class="form-select  rounded-0 select2" name="country" id="country">
                                    <option selected value="">@lang('locale.All Lands')</option>
                                    @foreach($countries as $code => $country)
                                        <option {{ $code == old('country',$export->country_code) ? "selected" : "" }} value="{{ $code }}">@lang('countries.'.$country)</option>
                                    @endforeach
                                </select>
                                @error('country')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-5 mt-2 pt-1">
                                <div class="input-group">
                                    <input type="text" name="city" value="{{$export->city}}" id="city" class="form-control rounded-0 " placeholder="@lang('locale.City')" aria-label="Username" aria-describedby="basic-addon1">
                                    @error('city')
                                    <div class="font-small-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mt-2 pt-1">
                                <div class="input-group">
                                    <select class="form-select  rounded-0 " name="objekt_type_code" id="objekt_type_code">
                                        <option selected  value="">@lang('locale.All Objekttyp')</option>
                                        @foreach($objektTypeCodes as $code => $objektName)
                                            <option {{ $code == old('objekt_type_code',$export->objekt_type_code) ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$objektName)</option>
                                        @endforeach
                                    </select>
                                    @error('objekt_type_code')
                                    <div class="font-small-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5 mt-2 pt-1">
                                <div class="input-group">
                                    <select class="form-select  rounded-0 " name="category" id="category">
                                        <option selected  value="">@lang('locale.All Kategorie')</option>
                                        @foreach($objektCategories as $code => $categoryName)
                                            <option {{ $code == old('category',$export->category) ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$categoryName)</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="font-small-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-7 mt-2 pt-1">
                                <select class="form-select  rounded-0 select2" name="projekt_type_code" id="projekt_type_code">
                                    <option selected  value="">@lang('locale.All Projektart')</option>
                                    @foreach($projektTypes as $code => $projektTypeName)
                                        <option {{ $code == old('projekt_type_code',$export->projekt_type_code) ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$projektTypeName)</option>
                                    @endforeach
                                </select>
                                @error('projekt_type_code')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-7 mt-2 pt-1">
                                <div class="input-group">
                                    <select class="form-select  rounded-0 " name="competence" id="competence">
                                        <option selected  value="">@lang('locale.All Leistungskompetenz')</option>
                                        @foreach($projektCompetenceTypes as $code => $projektCompetenceTypeName)
                                            <option {{ $code == old('competence',$export->competence) ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$projektCompetenceTypeName)</option>
                                        @endforeach
                                    </select>
                                    @error('competence')
                                    <div class="font-small-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-5 mt-2 pt-1 row pe-0">
                                <div class="col-7 col-lg-8 col-xl-7 pe-0">
                                    <p class="">@lang('locale.Wettkampf becken')</p>
                                </div>
                                <div class="col-5 col-lg-4 col-xl-5">

                <span class="text-nowrap me-1 me-lg-0">
                <input
                    type="radio"
                    id="competition_pool_yes_no"
                    class="form-check-input competition_pool"
                    name="competition_pool"
                    style="margin-bottom: 3px"  @if(empty($export->competition_pool)) checked @endif
                    value=""
                />
                <label class="form-check-label text-black fw-bold" for="competition_pool_yes_no">@lang('locale.Yes & No')</label>
              </span>
                <span class="text-nowrap me-1 me-lg-0">
                <input
                    type="radio"
                    id="competition_pool_no"
                    class="form-check-input competition_pool"
                    name="competition_pool"
                    style="margin-bottom: 3px" @if($export->competition_pool === 0) checked @endif
                    value="0"
                />
                <label class="form-check-label text-black fw-bold" for="competition_pool_no">@lang('locale.Nein')</label>
              </span>
                                    <span class="text-nowrap">
                <input
                    type="radio"
                    id="competition_pool_yes"
                    class="form-check-input competition_pool"
                    name="competition_pool" @if($export->competition_pool == 1) checked @endif
                    value="1"
                />
                <label class="form-check-label text-black fw-bold" for="competition_pool_yes">@lang('locale.Ja')</label>
              </span>
                                </div>
                                    @error('competition_pool')
                                    <div class="font-small-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            <div class="col-12 col-sm-7 col-lg-12 col-xl-12 col-xxl-7 mt-2 pt-1 row">
                                <div class="col-5">
                                    <p class="">@lang('locale.Wasser-fläche')</p>
                                </div>
                                <div class="col-7 text-start">
                <span class="text-nowrap">
                <input
                    type="radio"
                    id="water_surface_objekts"
                    class="form-check-input water_surface_type"
                    name="water_surface_type"
                    style="margin-bottom: 3px"  @if($export->water_surface_type == 'all-objekts') checked @endif
                    value="all-objekts"
                />
                <label class="form-check-label text-black fw-bold" for="water_surface_objekts">@lang('locale.Gesamtobjekt')</label>
              </span>
                                    <span class="text-nowrap">
                <input
                    type="radio"
                    id="water_surface_projekts"
                    class="form-check-input water_surface_type"
                    name="water_surface_type" @if($export->water_surface_type == 'all-projekts') checked @endif
                    value="all-projekts"
                />
                <label class="form-check-label text-black fw-bold" for="water_surface_projekts">@lang('locale.Projekt')</label>
              </span>
                                </div>
                                @error('water_surface_projekts')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-5 col-lg-6 col-xl-6 col-xxl-6 mt-2 pt-1 row d-flex justify-content-center justify-content-md-end justify-content-lg-center justify-content-xxl-end px-0">
                                <div class="col-4 pe-0">
                                    <div class="input-group">
                                        <select class="form-select  rounded-0 " name="water_surface_operator" id="water_surface_operator">
                                            @foreach($water_surface_operators as  $operator)
                                                <option {{ $operator == old('water_surface_operator',$export->water_surface_operator) ? "selected" : "" }} value="{{ $operator }}">{{$operator}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('water_surface_operator')
                                    <div class="font-small-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <input type="text" value="{{$export->water_surface_value}}" name="water_surface_value" id="water_surface_value" class="form-control rounded-0" placeholder="m2" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                @error('water_surface_value')
                                <div class="font-small-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6 col-sm-4 mt-2 pt-1 row">
                                <div class="col-12 pe-0">
                                    <p class="text-black fw-bolder">@lang('locale.Arge')</p>
                                </div>
                                <div class="col-12">

                <span class="text-nowrap me-1 me-lg-0">
                <input
                    type="radio"
                    id="arge_yes_no"
                    class="form-check-input arge"
                    name="arge"
                    style="margin-bottom: 3px" @if(empty($export->arge)) checked @endif
                    value=""
                />
                <label class="form-check-label text-black fw-bold" for="arge_yes_no">@lang('locale.Yes & No')</label>
              </span>
                <span class="text-nowrap">
                <input
                    type="radio"
                    id="arge_no"
                    class="form-check-input arge"
                    name="arge"
                    style="margin-bottom: 3px" @if($export->arge === 0) checked @endif
                    value="0"
                />
                <label class="form-check-label text-black fw-bold" for="arge_no">@lang('locale.Nein')</label>
              </span>
                                    <span class="text-nowrap">
                <input
                    type="radio"
                    id="arge_yes"
                    class="form-check-input arge"
                    name="arge" @if($export->arge == 1) checked @endif
                    value="1"
                />
                <label class="form-check-label text-black fw-bold" for="arge_yes">@lang('locale.Ja')</label>
              </span>
                                </div>
                                    @error('arge')
                                    <div class="font-small-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            <div class="col-6 col-sm-4 mt-2 pt-1 row">
                                <div class="col-12 pe-0">
                                    <p class="text-black fw-bolder">@lang('locale.PPP')</p>
                                </div>
                                <div class="col-12">

                <span class="text-nowrap me-1 me-lg-0">
                <input
                    type="radio"
                    id="ppp_yes_no"
                    class="form-check-input ppp"
                    name="ppp"
                    style="margin-bottom: 3px" @if(empty($export->ppp)) checked @endif
                    value=""
                />
                <label class="form-check-label text-black fw-bold" for="ppp_yes_no">@lang('locale.Yes & No')</label>
              </span>
                <span class="text-nowrap">
                <input
                    type="radio"
                    id="ppp_no"
                    class="form-check-input ppp"
                    name="ppp"
                    style="margin-bottom: 3px" @if($export->ppp === 0) checked @endif
                    value="0"
                />
                <label class="form-check-label text-black fw-bold" for="ppp_no">@lang('locale.Nein')</label>
              </span>
                                    <span class="text-nowrap">
                <input
                    type="radio"
                    id="ppp_yes"
                    class="form-check-input ppp"
                    name="ppp" @if($export->ppp == 1) checked @endif
                    value="1"
                />
                <label class="form-check-label text-black fw-bold" for="ppp_yes">@lang('locale.Ja')</label>
              </span>
                            </div>
                                    @error('ppp')
                                    <div class="font-small-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            <div class="col-12 mt-2 pt-2 mb-2 ">
                                <a class="add-new btn btn-primary w-100 mx-auto text-white border-0 fs-4 calibribold h-100 py-1" id="export-filter-btn">
                                    Search</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-0 border-1 shadow-none">
                        <div class="card-header d-none">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="card-body row mt-2">
                            <div class="col-6">
                                <button id="excel_download_btn" class="bg-secondary w-100 mx-auto text-white border-0 fs-5 calibribold h-100 py-1" type="button">
                                    @lang('locale.XLS Download')</button>
                            </div>
                            <div class="col-6">
                                <a href="{{ $weblink }}" class="btn add-new btn btn-primary w-100 mx-auto text-white border-0 fs-5 calibribold h-100 py-1">
                                    @lang('locale.Weblink')</a>
                            </div>
                        </div>
                    </div>
                </div>
        </aside>
        {{-- </> --}}
        <div class="col-12 col-lg-7">
            <div class="col-12">
                <div class="card rounded-0 border-1 shadow-none">
                    <div class="card-header d-none">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body row p-1 d-flex justify-content-end">
                        <div class="col-8 col-md-9 row d-flex align-items-center">
                            <p class="text-black col-7 col-md-6 col-lg-7 fs-5 fw-bold fs-4 px-0 calibri mb-0 ">
                                <input type="text" name="name" value="{{$export->name}}" class="form-control rounded-0" placeholder="@lang('locale.Export Namen eingeben')" aria-label="Username" aria-describedby="basic-addon1">

                            </p>
                            <input type="hidden"  name="object_count"  id="object_count">
                            <input type="hidden"  name="project_count" id="project_count">

                            </form>
                            <span class="col-4 ps-1 ml-2">
            <a href="#" title="@lang('locale.Delete Export')" class="action-btn text-danger del-btn"><i class="fa fa-trash"></i></a>
            <form action="{{ route('exports.destroy', $export->id) }}" method="post" class="delete-btn-form d-inline">
                @method('DELETE')
                @csrf
            </form>
            </span>
                        </div>
                        <div class="col-4 col-md-3 d-flex justify-content pe-0">
                            <button id="update-export" class="add-new btn btn-primary mx-auto text-white border-0 fs-5 calibribold h-100 w-75" type="submit">
                                Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card rounded-0 border-1 shadow-none">
                    <div class="card-header d-none">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <section class="app-reference-list">
                            <!-- list and filter start -->
                            <div class="card-datatable table-responsive pt-0">
                                <table class="export-list-table table ">
                                    <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>@lang("locale.Objekt")</th>
                                        <th>@lang("locale.Ort")</th>
                                        <th>@lang("locale.Kategorie")</th>
                                        <th>@lang("locale.Anzahl Projekte")</th>
                                        <th>@lang("locale.Actions")</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            @endsection

            @section('vendor-script')
                {{-- Vendor js files --}}
                <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
                <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
                <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
                <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
                <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
                <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
            @endsection

            @section('page-script')
                {{-- Page js files --}}
                <script>
                    toastr.options = {
                        "closeButton": true,
                        "newestOnTop": true,
                        "positionClass": "toast-top-right"
                    };
                    $('.export-list-table').DataTable({
                        processing: true,
                        serverSide: true,
                        searching: false,
                        ajax: {
                            url:'{{ route('exports.filter.data') }}',
                            type: "GET",
                            data: function (d) {
                                d.search = $('#search').val();
                                d.start_year = $('#start_year').val();
                                d.end_year = $('#end_year').val();
                                d.city = $('#city').val();
                                d.country = $('#country').val();
                                d.objekt_type_code = $('#objekt_type_code').val();
                                d.category = $('#category').val();
                                d.projekt_type_code = $('#projekt_type_code').val();
                                d.competence = $('#competence').val();
                                d.competition_pool = $('.competition_pool:checked').val();
                                d.water_surface_type = $('.water_surface_type:checked').val();
                                d.water_surface_operator = $('#water_surface_operator').val();
                                d.water_surface_value = $('#water_surface_value').val();
                                d.arge = $('.arge:checked').val();
                                d.ppp = $('.ppp:checked').val();
                            },
                            error: function(response){
                                $.each(response.responseJSON.errors,function(index,value ){
                                    toastr.error(value);
                                })
                            }
                        }, // JSON file to add data
                        columns: [
                            // columns according to JSON
                            { data: '' },
                            { data: 'name' },
                            { data: 'city' },
                            { data: 'category' },
                            { data: 'projekt_count' },
                            { data: 'action', orderable: false, searchable: false }
                        ],
                        columnDefs: [
                            {
                                // For Responsive
                                className: 'control',
                                orderable: false,
                                responsivePriority: 2,
                                targets: 0,
                                render: function (data, type, full, meta) {
                                    return ''
                                }
                            }
                        ],
                        language: {
                            paginate: {
                                previous: '&nbsp;',
                                next: '&nbsp;'
                            }
                        },
                        drawCallback: function(response){
                            // this to see what exactly is being sent back
                            data_columns = response.json;
                            $("#object_count").val(data_columns.objekt_count);
                            $("#project_count").val(data_columns.projekt_count);
                        }
                    });
                    // }

                    $('#export-filter-btn').click(function () {
                        $('.export-list-table').DataTable().draw(true);
                    });

                    $('#update-export').click(function (){
                        $('#export_filter_form').submit();
                    });

                    $(document).on('keypress', "#export_filter_form input", function (e) {
                        if (e.which == 13) {
                            $('.export-list-table').DataTable().draw(true);
                            return false;    //<---- Add this line
                        }
                    });

                    $('#excel_download_btn').click(function (){
                        // $('#excel_download').val(1);
                        var query =  {
                            search : $('#search').val(),
                            start_year : $('#start_year').val(),
                            end_year : $('#end_year').val(),
                            city : $('#city').val(),
                            country : $('#country').val(),
                            objekt_type_code : $('#objekt_type_code').val(),
                            category : $('#category').val(),
                            projekt_type_code : $('#projekt_type_code').val(),
                            competence : $('#competence').val(),
                            competition_pool : $('.competition_pool:checked').val(),
                            water_surface_type : $('.water_surface_type:checked').val(),
                            water_surface_operator : $('#water_surface_operator').val(),
                            water_surface_value : $('#water_surface_value').val(),
                            arge : $('.arge:checked').val(),
                            ppp : $('.ppp:checked').val()
                        };

                        var url  ="{{route('exports.download.data')}}?"+$.param(query);

                        window.location = url;
                    });
                </script>
@endsection
