<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css" integrity="sha512-ioRJH7yXnyX+7fXTQEKPULWkMn3CqMcapK0NNtCN8q//sW7ZeVFcbMJ9RvX99TwDg6P8rAH2IqUSt2TLab4Xmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/frontend-style.css') }}"  type="text/css"/>
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
</head>
<body>
<header class="container-fluid bg-lightblue lightgrey-bottom-border">
    <nav class="navbar navbar-expand-lg navbar-light container py-4" >
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo.svg') }}" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase tx-grey me-3" id="home" aria-current="page" href="#home">@lang('locale.Home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase tx-grey me-3" id="unternehmen" href="#unternehmen">@lang('locale.Companies')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase tx-grey me-3" id="leistungen" href="#leistungen">@lang('locale.Services')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase tx-grey me-3" id="referenzen" href="#referenzen">@lang('locale.References')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase tx-grey me-3" id="kontakt" href="#kontakt">@lang('locale.Contact')</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <select class="form-select lang-dropdown me-1">
                        <option value="de" href="{{ url('lang/de') }}" {{ config('app.locale') == 'de' ? "selected" : '' }} data-language="de">DE</option>
                        <option value="en" href="{{ url('lang/en') }}" {{ config('app.locale') == 'en' ? "selected" : '' }} data-language="en">EN</option>
                        <option value="en" href="{{ url('lang/fr') }}" {{ config('app.locale') == 'fr' ? "selected" : '' }} data-language="fr">FR</option>
                    </select>

                    <a href="#" class="btn text-nowrap btn-primary text-uppercase bg-mediumblue text-white border-0 calibribold">@lang('locale.Inquiry Now')</a>
                </div>
            </div>
        </div>
    </nav>
</header>
@yield('content')
<footer class="container-fluid bg-lightblue">
    <div class="container">
        <div class="text-end">
            <img src="{{ asset('images/icons/backtotop.svg') }}"
                 onclick="$('html, body').animate({scrollTop: '0px'}, 300)"
                 width="65px"
                 height="65px"
                 class="position-relative backtotop-icon" />
        </div>
        <div class="text-center">
            <div class="pt-4 pb-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.svg') }}" class="pt-3 pb-1" />
                </a>
                <div class="pt-4 pb-3">
                    <ul class="row list-unstyled d-flex justify-content-center">
                        <li class="col-5 text-end">
                            <a class="text-decoration-none me-0 text-uppercase text-dark small" aria-current="page" href="/imprint">@lang('locale.Imprint')</a>
                        </li>
                        <li class="col-1">
                            <a class="text-decoration-none text-uppercase text-dark small" href="/conditions">@lang('locale.Conditions')</a>
                        </li>
                        <li class="col-5 text-start">
                            <a class="text-decoration-none text-uppercase text-dark small" href="/privacy">@lang('locale.Privacy')</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row py-4 darkgrey-top-border">
                <div class="col-6 text-start py-1 calibribold">&copy; @lang('locale.Berndorf Bäderbau Projekt GmbH') <?php echo date('Y') ?></div>
                <div class="col-6 text-end py-1">
                    <a href="/linkedIn" class="me-3 text-decoration-none">
                        <img src="{{ asset('images/icons/linkedIn.svg') }}"
                             width="25px"
                             height="25px" />
                    </a>
                    <a href="/facebook" class="ms-3 text-decoration-none">
                        <img src="{{ asset('images/icons/facebook.svg') }}"
                             width="25px"
                             height="25px" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_GEOCODING_API_KEY') }}&callback=initMap&v=weekly"
    defer
></script>
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script>
    $(function() {
        $('.small-img').click(function () {
            $('.imagepreview').attr('src', $(this).attr('src'));
            $('#imagemodal').modal('show');
        });
        $(".closeImageModal").click(function () {
            $('#imagemodal').modal('hide');
        });
        $(".lang-dropdown").change(function () {
            window.location.href = $(this).find("option:selected").attr('href')
        });
        $(".date-picker").flatpickr({
            defaultDate:'null',
            dateFormat:"d-m-Y",
        });



        $(document).on("change", ".date-picker", function () {
           $(this).next('.date-clear').toggle($(this).val() != '')
        });
        $(document).on("click", ".date-clear", function () {
            $(this).prev('.date-picker').val('').trigger('change');
        });
    });
    var mapOptions = {
        zoom: 3,
        disableAutoPan: true,
        mapTypeControl	:	false,
        center: {lat: 47.80949, lng: 13.05501},
        styles: [
            {
                featureType: "all",
                elementType: "labels",
                stylers: [
                    { visibility: "off" },
                ]
            },
            {
                "featureType": "landscape",
                "stylers": [{
                    "saturation": -100
                }, {
                    "lightness": 70
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi",
                "stylers": [{
                    "saturation": -100
                }, {
                    "lightness": 51
                }, {
                    "visibility": "simplified"
                }]
            }, {
                "featureType": "road",
                "stylers": [{
                    "saturation": -100
                }, {
                    "lightness": 100
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "transit",
                "stylers": [{
                    "saturation": -100
                }, {
                    "visibility": "simplified"
                }]
            }, {
                "featureType": "administrative.province",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{
                    "hue": "#fff"
                }, {
                    "lightness": 25
                }, {
                    "saturation": -100
                }, {
                    "hue": "#fff"
                }]
            },
            {
                stylers: [
                    {hue: "#ccc"}
                ]
            },
            {
                featureType: "administrative",
                elementType: "labels",
                stylers: [
                    { visibility: "off" }
                ]
            },{
                featureType: "poi",
                elementType: "labels",
                stylers: [
                    { visibility: "off" }
                ]
            },{
                featureType: "water",
                elementType: "labels",
                stylers: [
                    { visibility: "off" }
                ]
            },{
                featureType: "road",
                elementType: "labels",
                stylers: [
                    { visibility: "off" }
                ]
            }
        ],
        // your other options here
    };

    function initMap() {

        if($('#map').length > 0) {
            const map = new google.maps.Map(document.getElementById("map"), mapOptions);
            setMarkers(map);
        }
    }


    function setMarkers(map) {
        //var bounds = new google.maps.LatLngBounds();
        let markers = [];
        $.each(locations, function (x,y) {

            if(y.latitude != '' && y.latitude != '0' && y.longitude != '' && y.longitude != '0') {
                let marker = new google.maps.Marker({
                    position: {lat: y.latitude, lng: y.longitude},
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 8,
                        fillOpacity: 1,
                        strokeWeight: 2,
                        fillColor: '#004DA1',
                        strokeColor: '#ffffff',
                    },
                    title: y.name,
                    zIndex: x,
                });

                //bounds.extend({ lat: y.latitude, lng: y.longitude })


                var infowindow = new google.maps.InfoWindow({
                    content: '<div id="content">' +
                        '<a class="text-decoration-none" href="{{ route('objekts',"") }}/' + y.id + '">' +
                        '<div class="position-relative card-img-container">' +
                        '<img src="' + y.image + '" alt="' + y.name + '" style="width: 220px !important; height: auto !important;" class="position-relative card-img" width="200" />' +
                        '<form class="google-card-button" >' +
                        '<button class="bg-mediumblue text-decoration-none px-3 py-2 text-white border-0 calibribold">' + y.year + '</button>' +
                        '</form>' +
                        '</div>' +
                        '<h3 class="calibribold text-dark">' + y.name + '</h3>' +
                        '<p class="calibri tx-grey">' + y.country + '</p>' +
                        '</a></div>',
                    maxWidth: 250
                });

                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });
                markers.push(marker);
            }
        });

        new markerClusterer.MarkerClusterer({ map, markers });

        //map.fitBounds(bounds);

    }

    window.initMap = initMap;
</script>
</body>
</html>
