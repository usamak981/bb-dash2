@extends('layouts/contentLayoutMaster')

@section('title', __('locale.Data Export'))

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('content')
    <div class="card rounded-0 border-1 shadow-none">
        <div class="card-header d-none">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
            <div class="table-container mt-1">

                <section class="app-export-list">
                    <!-- list and filter start -->
                    <div class="card-datatable table-responsive pt-0">
                        <table class="export-list-table table">
                            <thead class="table-light">
                            <tr>
                                <th></th>
                                <th>@lang("locale.Exportname")</th>
                                <th>@lang("locale.Kategorie")</th>
                                <th>@lang("locale.Ort")</th>
                                <th>@lang("locale.Datum")</th>
                                <th>@lang("locale.Anzahl")</th>
                                <th>@lang("locale.country")</th>
                                <th>@lang("locale.Objekt Type")</th>
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
        $(function () {
            var dtexportTable = $('.export-list-table'),
                select = $('.select2')

            var assetPath = '../../../app-assets/',
                exportView = 'app-export-view-account.html'

            if ($('body').attr('data-framework') === 'laravel') {
                assetPath = $('body').attr('data-asset-path')
                exportView = assetPath + 'export'
            }

            select.each(function () {
                var $this = $(this)
                $this.wrap('<div class="position-relative"></div>')
                $this.select2({
                    // the following code is used to disable x-scrollbar when click in select input and
                    // take 100% width in responsive also
                    dropdownAutoWidth: true,
                    width: '100%',
                    dropdownParent: $this.parent()
                })
            })

            // exports List datatable
            if (dtexportTable.length) {
                dtexportTable.DataTable({
                    'processing': true,
                    'serverSide': true,
                    ajax: {
                        url:'{{ route('exports.index.data') }}',
                        type: "GET",
                        data: function (d) {
                            d.country = $(document).find('#export_country_filter').length ? $(document).find('#export_country_filter').val() : '';
                            d.category = $(document).find('#export_category_filter').length ? $(document).find('#export_category_filter').val() : '';
                            d.objekt_type = $(document).find('#export_objekt_type_filter').length ? $(document).find('#export_objekt_type_filter').val() : '';
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
                        { data: 'category' },
                        { data: 'city' },
                        { data: 'date' },
                        { data: 'number' },
                        { data: 'country' , visible: false },
                        { data: 'objekt_type_code' ,  visible: false  },
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
                    dom:
                        '<"d-flex justify-content-between align-items-center header-actions row mt-75 mb-2"' +
                        '<"col-sm-12 col-lg-9 d-flex justify-content-center justify-content-lg-start" <"search-filter me-2 "f> <"export_categories mt-1 me-2"> <"export_countries mt-1 me-2"> <"export_object_types mt-1 me-2"> >' +
                        '<"col-sm-12 col-lg-3 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"B>>' +
                        '>t' +
                        '<"d-flex justify-content-between mx-2 row mb-1"' +
                        '<"col-sm-12 col-md-6"i>' +
                        '<"col-sm-12 col-md-6"p>' +
                        '>',
                    language: {
                        search: '',
                        searchPlaceholder: '{{ __('locale.Search') }}',
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    },
                    // Buttons with Dropdown
                    buttons: [
                        {
                            text: '<i class="fa fa-plus"></i> {{ __('locale.Create Export') }}',
                            className: 'add-new btn btn-primary',
                            action: function ( e, dt, button, config ) {
                                window.location = '{{ route('exports.create') }}';
                            }
                        }
                    ],
                    // For responsive popup
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row) {
                                    var data = row.data()
                                    return 'Details of ' + data['full_name']
                                }
                            }),
                            type: 'column',
                            renderer: function (api, rowIdx, columns) {
                                var data = $.map(columns, function (col, i) {
                                    return col.columnIndex !== 5 // ? Do not show row in modal popup if title is blank (for check box)
                                        ? '<tr data-dt-row="' +
                                        col.rowIdx +
                                        '" data-dt-column="' +
                                        col.columnIndex + '">' +
                                        '<td>' + col.title + ':' + '</td> ' + '<td>' + col.data + '</td>' + '</tr>'
                                        : ''
                                }).join('')
                                return data ? $('<table class="table">').append('<tbody>' + data + '</tbody>') : false
                            }
                        }
                    },
                    initComplete: function () {

                        @php $typeSelect = "<select id='export_objekt_type_filter' class='form-select text-capitalize mb-md-0 mb-2'><option value=''>" . __('locale.All Object Types') . "</option>"; @endphp
                        @foreach($objektTypes as $code => $type)
                        @php $typeSelect .= "<option value='$code'>" . __('locale.'.$type) . "</option>"; @endphp
                        @endforeach
                        @php $typeSelect .= "</select>"; @endphp
                        $("{!!  $typeSelect  !!}").appendTo('.export_object_types').on("change", function (){
                            $(".export-list-table").DataTable().draw(true);
                        });

                        @php $categorySelect = "<select id='export_category_filter' class='form-select text-capitalize mb-md-0 mb-2'><option value=''>" . __('locale.All Categories') . "</option>"; @endphp
                        @foreach($objektCategories as $code => $type)
                        @php $categorySelect .= "<option value='$code'>" . __('locale.'.$type) . "</option>"; @endphp
                        @endforeach
                        @php $categorySelect .= "</select>"; @endphp
                        $("{!!  $categorySelect  !!}").appendTo('.export_categories').on("change", function (){
                            $(".export-list-table").DataTable().draw(true);
                        });

                        @php $countrySelect = "<select id='export_country_filter' class='form-select text-capitalize mb-md-0 mb-2'><option value=''>" . __('locale.All Countries') . "</option>"; @endphp
                        @foreach($countries as $code => $type)
                        @php $countrySelect .= "<option value='$code'>" . __('countries.'.$type) . "</option>"; @endphp
                        @endforeach
                        @php $countrySelect .= "</select>"; @endphp
                        $("{!!  $countrySelect  !!}").appendTo('.export_countries').on("change", function (){
                            $(".export-list-table").DataTable().draw(true);
                        });

                    }
                });
            }

        });
    </script>
@endsection
