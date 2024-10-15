@extends('layouts/contentLayoutMaster')

@section('title', __('locale.Users'))

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
    <!-- users list start -->
    <section class="app-user-list">
        <!-- list and filter start -->
        <div class="card-datatable table-responsive pt-0">
            <table class="user-list-table table">
                <thead class="table-light">
                <tr>
                    <th></th>
                    <th>@lang("locale.Name")</th>
                    <th>@lang("locale.Email Address")</th>
                    <th>@lang("locale.Role")</th>
                    <th>@lang("locale.Created At")</th>
                    <th>@lang("locale.Actions")</th>
                </tr>
                </thead>
            </table>
        </div>
    </section>
    <!-- users list ends -->
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
            var dtUserTable = $('.user-list-table'),
                select = $('.select2')

            var assetPath = '../../../app-assets/',
                userView = 'app-user-view-account.html'

            if ($('body').attr('data-framework') === 'laravel') {
                assetPath = $('body').attr('data-asset-path')
                userView = assetPath + 'users'
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

            // Users List datatable
            if (dtUserTable.length) {
                dtUserTable.DataTable({
                    'processing': true,
                    'serverSide': true,
                    ajax: {
                        url:'{{ route('users.index.data') }}',
                        type: "GET",
                        data: function (d) {
                            d.role = $(document).find('#user_role_filter').length ? $(document).find('#user_role_filter').val() : '';
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
                        { data: 'full_name' },
                        { data: 'email' },
                        { data: 'role' },
                        { data: 'created_at' },
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
                        '<"d-flex justify-content-between align-items-center header-actions row mt-75"' +
                        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" <"search-filter me-2"f> <"user_role mt-1"> >' +
                        '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"B>>' +
                        '>t' +
                        '<"d-flex justify-content-between mx-2 row mb-1"' +
                        '<"col-sm-12 col-md-6"i>' +
                        '<"col-sm-12 col-md-6"p>' +
                        '>',
                    language: {
                        search: '',
                        searchPlaceholder: '{{ __('Search') }}',
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    },
                    // Buttons with Dropdown
                    buttons: [
                        {
                            text: '<i class="fa fa-plus"></i> {{ __('Add User') }}',
                            className: 'add-new btn btn-primary',
                            action: function ( e, dt, button, config ) {
                                window.location = '{{ route('users.create') }}';
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

                        @php $roleSelect = "<select id='user_role_filter' class='form-select text-capitalize mb-md-0 mb-2'><option value=''>" . __('locale.All Roles') . "</option>"; @endphp
                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                        @php $roleSelect .= "<option value='" . $role->name . "'>" . $role->name . "</option>"; @endphp
                        @endforeach
                        @php $roleSelect .= "</select>"; @endphp
                        $("{!!  $roleSelect  !!}").appendTo('.user_role').on("change", function (){
                            $(".user-list-table").DataTable().draw(true);
                        });

                    }
                });
            }

        });
    </script>
@endsection
