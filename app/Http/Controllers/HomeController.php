<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Country;
use App\Models\Image;
use App\Models\Objekt;
use App\Models\Projekt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request){

        $afterCheck = $request->has('start_date') && $request->filled('start_date') ? '|after_or_equal:start_date' : '';

        $request->validate([
            'start_date' => 'nullable|date|date_format:d-m-Y',
            'end_date' => 'nullable|date|date_format:d-m-Y' . $afterCheck
        ]);

        $references = Helpers::filterReferences($request)->latest()->paginate(12)->withQueryString();

        $locations = [];
        $allObjekts = Helpers::filterReferences($request)->get();
        if(!empty($allObjekts)){
            $locations = $allObjekts->map(function ($item){
                $data['image'] = Helpers::getImageSrc($item->images->first()?->thumb_path);
                $data['name'] = $item->name;
                $data['id'] = $item->id;
                $data['country'] = $item->country?->name;
                $data['year'] = $item->projekts->max('end_year');
                $data['longitude'] = (float)$item->longitude;
                $data['latitude'] = (float)$item->latitude;
                return $data;
            });
        }

        return view('content.home', [
            'references' => $references,
            'countries' => Country::pluck('name', 'code'),
            'objektTypeCodes' => Objekt::$objekt_type_codes,
            'projektConstructionTypes' => Projekt::$projekt_construction_types,
            'projektCompetenceTypes' => Projekt::$projekt_competence_types,
            'locations' => $locations->toArray()
        ]);
    }


    /**
     * @param Objekt $objekt
     * @return View
     */
    public function show(Objekt $objekt) {
        $startTime = Carbon::createFromFormat("Y-m-d", $objekt->projekts->min('start_year') . "-" . $objekt->projekts->min('start_month') . "-01");
        $endTime = Carbon::createFromFormat("Y-m-d", $objekt->projekts->max('end_year') . "-" . $objekt->projekts->max('end_month') . "-31");
        return view('content.objekt', [
            'objekt' => $objekt,
            'duration' => $startTime->diffInMonths($endTime),
            'constructions' => Projekt::$projekt_construction_types,
            'competences' => Projekt::$projekt_competence_types,
            'categories' => Objekt::$objekt_categories,
            'objektTypes' => Objekt::$objekt_type_codes,
        ]);
    }

    /**
     * @param Objekt $objekt
     * @return View
     */
    public function showVersionB(Objekt $objekt) {
        $startTime = Carbon::createFromFormat("Y-m-d", $objekt->projekts->min('start_year') . "-" . $objekt->projekts->min('start_month') . "-01");
        $endTime = Carbon::createFromFormat("Y-m-d", $objekt->projekts->max('end_year') . "-" . $objekt->projekts->max('end_month') . "-31");
        return view('content.objekt_and_links', [
            'objekt' => $objekt,
            'duration' => $startTime->diffInMonths($endTime),
            'constructions' => Projekt::$projekt_construction_types,
            'competences' => Projekt::$projekt_competence_types,
            'categories' => Objekt::$objekt_categories,
            'objektTypes' => Objekt::$objekt_type_codes,
        ]);
    }


    public function imagesNotFoundCount() {
        $images = Image::with([])->select('web_path')->get();
        $notFound = [];
        foreach ($images as $img){
            if(!Storage::disk('public')->exists($img->web_path)){
                $notFound[] = $img->web_path;
            }
        }
        dd($notFound);
    }
}
