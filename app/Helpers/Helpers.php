<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Objekt;
use Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helpers
{
    public static function applClasses()
    {
        // default data array
        $DefaultData = [
            'mainLayoutType' => 'vertical',
            'theme' => 'light',
            'sidebarCollapsed' => false,
            'navbarColor' => '',
            'horizontalMenuType' => 'floating',
            'verticalMenuNavbarType' => 'floating',
            'footerType' => 'static', //footer
            'layoutWidth' => 'boxed',
            'showMenu' => true,
            'bodyClass' => '',
            'pageClass' => '',
            'pageHeader' => true,
            'contentLayout' => 'default',
            'blankPage' => false,
            'defaultLanguage' => 'en',
            'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'),
        ];

        // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($DefaultData, config('custom.custom'));

        // All options available in the template
        $allOptions = [
            'mainLayoutType' => array('vertical', 'horizontal'),
            'theme' => array('light' => 'light', 'dark' => 'dark-layout', 'bordered' => 'bordered-layout', 'semi-dark' => 'semi-dark-layout'),
            'sidebarCollapsed' => array(true, false),
            'showMenu' => array(true, false),
            'layoutWidth' => array('full', 'boxed'),
            'navbarColor' => array('bg-primary', 'bg-info', 'bg-warning', 'bg-success', 'bg-danger', 'bg-dark'),
            'horizontalMenuType' => array('floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky'),
            'horizontalMenuClass' => array('static' => '', 'sticky' => 'fixed-top', 'floating' => 'floating-nav'),
            'verticalMenuNavbarType' => array('floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky', 'hidden' => 'navbar-hidden'),
            'navbarClass' => array('floating' => 'floating-nav', 'static' => 'navbar-static-top', 'sticky' => 'fixed-top', 'hidden' => 'd-none'),
            'footerType' => array('static' => 'footer-static', 'sticky' => 'footer-fixed', 'hidden' => 'footer-hidden'),
            'pageHeader' => array(true, false),
            'contentLayout' => array('default', 'content-left-sidebar', 'content-right-sidebar', 'content-detached-left-sidebar', 'content-detached-right-sidebar'),
            'blankPage' => array(false, true),
            'sidebarPositionClass' => array('content-left-sidebar' => 'sidebar-left', 'content-right-sidebar' => 'sidebar-right', 'content-detached-left-sidebar' => 'sidebar-detached sidebar-left', 'content-detached-right-sidebar' => 'sidebar-detached sidebar-right', 'default' => 'default-sidebar-position'),
            'contentsidebarClass' => array('content-left-sidebar' => 'content-right', 'content-right-sidebar' => 'content-left', 'content-detached-left-sidebar' => 'content-detached content-right', 'content-detached-right-sidebar' => 'content-detached content-left', 'default' => 'default-sidebar'),
            'defaultLanguage' => array('en' => 'en', 'fr' => 'fr', 'de' => 'de', 'pt' => 'pt'),
            'direction' => array('ltr', 'rtl'),
        ];

        //if mainLayoutType value empty or not match with default options in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (array_key_exists($key, $DefaultData)) {
                if (gettype($DefaultData[$key]) === gettype($data[$key])) {
                    // data key should be string
                    if (is_string($data[$key])) {
                        // data key should not be empty
                        if (isset($data[$key]) && $data[$key] !== null) {
                            // data key should not be exist inside allOptions array's sub array
                            if (!array_key_exists($data[$key], $value)) {
                                // ensure that passed value should be match with any of allOptions array value
                                $result = array_search($data[$key], $value, 'strict');
                                if (empty($result) && $result !== 0) {
                                    $data[$key] = $DefaultData[$key];
                                }
                            }
                        } else {
                            // if data key not set or
                            $data[$key] = $DefaultData[$key];
                        }
                    }
                } else {
                    $data[$key] = $DefaultData[$key];
                }
            }
        }

        //layout classes
        $layoutClasses = [
            'theme' => $data['theme'],
            'layoutTheme' => $allOptions['theme'][$data['theme']],
            'sidebarCollapsed' => $data['sidebarCollapsed'],
            'showMenu' => $data['showMenu'],
            'layoutWidth' => $data['layoutWidth'],
            'verticalMenuNavbarType' => $allOptions['verticalMenuNavbarType'][$data['verticalMenuNavbarType']],
            'navbarClass' => $allOptions['navbarClass'][$data['verticalMenuNavbarType']],
            'navbarColor' => $data['navbarColor'],
            'horizontalMenuType' => $allOptions['horizontalMenuType'][$data['horizontalMenuType']],
            'horizontalMenuClass' => $allOptions['horizontalMenuClass'][$data['horizontalMenuType']],
            'footerType' => $allOptions['footerType'][$data['footerType']],
            'sidebarClass' => '',
            'bodyClass' => $data['bodyClass'],
            'pageClass' => $data['pageClass'],
            'pageHeader' => $data['pageHeader'],
            'blankPage' => $data['blankPage'],
            'blankPageClass' => '',
            'contentLayout' => $data['contentLayout'],
            'sidebarPositionClass' => $allOptions['sidebarPositionClass'][$data['contentLayout']],
            'contentsidebarClass' => $allOptions['contentsidebarClass'][$data['contentLayout']],
            'mainLayoutType' => $data['mainLayoutType'],
            'defaultLanguage' => $allOptions['defaultLanguage'][$data['defaultLanguage']],
            'direction' => $data['direction'],
        ];
        // set default language if session hasn't locale value the set default language
        if (!session()->has('locale')) {
            app()->setLocale($layoutClasses['defaultLanguage']);
        }

        // sidebar Collapsed
        if ($layoutClasses['sidebarCollapsed'] == 'true') {
            $layoutClasses['sidebarClass'] = "menu-collapsed";
        }

        // blank page class
        if ($layoutClasses['blankPage'] == 'true') {
            $layoutClasses['blankPageClass'] = "blank-page";
        }

        return $layoutClasses;
    }

    public static function updatePageConfig($pageConfigs)
    {
        $demo = 'custom';
        if (isset($pageConfigs)) {
            if (count($pageConfigs) > 0) {
                foreach ($pageConfigs as $config => $val) {
                    Config::set('custom.' . $demo . '.' . $config, $val);
                }
            }
        }
    }


    public static function getImageSrc($path){
        return !empty($path) && Storage::disk('public')->exists($path) ?
            asset('storage/'.$path) :
            asset('images/default/no-preview-available.png');
    }

    public static function projektQuery(&$q, $request) {
        $q->when($request->has('start_date') && $request->filled('start_date'), function ($query) use($request) {
            $timestamp = strtotime($request->start_date);
            $query->where('start_year', ">=", date('Y', $timestamp));
            $query->where('start_month', ">=", date('m', $timestamp));
        })->when($request->has('end_date') && $request->filled('end_date'), function ($query) use($request) {
            $timestamp = strtotime($request->end_date);
            $query->where('end_year', "<=", date('Y', $timestamp));
            $query->where('end_month', "<=", date('m', $timestamp));
        })->when($request->has('start_year') && $request->filled('start_year'), function ($query) use($request) {
            $query->where('end_year', ">=", $request->start_year);
        })->when($request->has('end_year') && $request->filled('end_year'), function ($query) use($request) {
            $query->where('end_year', "<=", $request->end_year);
        })->when($request->has('projekt_type_code') && $request->filled('projekt_type_code'), function ($query) use($request) {
            $query->where('projekt_type_code', $request->projekt_type_code);
        })->when($request->has('competence') && $request->filled('competence'), function ($query) use($request) {
            $query->where('competence',$request->competence);
        })->when($request->has('construction') && $request->filled('construction'), function ($query) use($request) {
            $query->where('construction',$request->construction);
        })->when($request->has('competition_pool') && $request->filled('competition_pool'), function ($query) use($request) {
            $query->where('sports_pool',$request->competition_pool);
        })->when($request->has('arge') && $request->filled('arge'), function ($query) use($request) {
            $query->where('arge',$request->arge);
        })->when($request->has('ppp') && $request->filled('ppp'), function ($query) use($request) {
            $query->where('ppp',$request->ppp);
        })->when($request->has('water_surface_type') && $request->filled('water_surface_type') &&
            $request->water_surface_type == 'all-projekts' &&
            $request->has('water_surface_operator') && $request->filled('water_surface_operator') &&
            $request->has('water_surface_value') && $request->filled('water_surface_value'), function ($query) use($request) {
            $query->where('surface', $request->water_surface_operator, $request->water_surface_value);
        });
    }

    public static function filterReferences($request, $hasProjekts = true){
        $references = Objekt::with([
            'projekts' => function($q) use($request) {
                self::projektQuery($q, $request);
            },
            'images',
            'country'
        ])->when($hasProjekts, function ($query) use($request) {
            $query->whereHas('projekts', function($q) use($request) {
                self::projektQuery($q, $request);
            });
        })->when($request->has('country') && $request->filled('country'), function ($query) use($request) {
            $query->where('country_code', $request->country);
        })->when($request->has('city') && $request->filled('city'), function ($query) use($request) {
            $query->where('city', $request->city);
            $query->orWhere('postal_code', $request->city);
        })->when($request->has('objekt_type_code') && $request->filled('objekt_type_code'), function ($query) use($request) {
            $query->where('objekt_type_code', $request->objekt_type_code);
        })->when($request->has('category') && $request->filled('category'), function ($query) use($request) {
            $query->where('category', $request->category);
        })->when($request->has('search') && $request->filled('search'), function ($query) use($request) {
            $query->where('name', 'like', "%" . $request->search . "%");
        })->when($request->has('postal_code_city') && $request->filled('postal_code_city'), function ($query) use($request) {
            $query->where('postal_code', $request->postal_code_city);
            $query->orWhere('city', $request->postal_code_city);
        })->when($request->has('water_surface_type') && $request->filled('water_surface_type') &&
            $request->water_surface_type == 'all-objekts' &&
            $request->has('water_surface_operator') && $request->filled('water_surface_operator') &&
            $request->has('water_surface_value') && $request->filled('water_surface_value'), function ($query) use($request) {
            $query->where('total_water_surface', $request->water_surface_operator, $request->water_surface_value);
        });


        return $references;
    }
}
