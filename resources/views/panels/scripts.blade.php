<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
@yield('vendor-script')
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<script src="{{ asset(mix('js/scripts/extensions/ext-component-sweet-alerts.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>
<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
    <script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')

@if(in_array(Route::currentRouteName(), ['login']))
    <style>
        .toast-top-center {
            top: 16% !important;
        }
    </style>

    <script>
        $(function (){
            toastr.options.positionClass = 'toast-top-center'
        })
    </script>
@endif
<!-- END: Page JS-->
@if($errors->any())
    <script type="text/javascript">
        $(function(){
            @foreach($errors->all() as $err)
            toastr.error("{{ $err }}");
            @endforeach
        });
    </script>
@endif


@if(session()->has('message'))
    <script type="text/javascript">
        $(function(){
            toastr.success("{{ session()->get('message') }}");
        });
    </script>
@endif
