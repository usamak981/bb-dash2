<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Image;
use App\Models\Objekt;
use App\Http\Requests\StoreObjektRequest;
use App\Http\Requests\UpdateObjektRequest;
use App\Models\Projekt;
use App\Models\ProjektType;
use App\Services\YajraDataTableService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Spatie\Geocoder\Facades\Geocoder;
use Yajra\DataTables\DataTables;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => \request()->url(), 'name' => __('locale.References')],
            ['name' => __('locale.Index')]
        ];

        return view('content.references.index', [
            'breadcrumbs' => $breadcrumbs,
            'countries' => Country::pluck('name', 'code'),
            'objektTypes' => Objekt::$objekt_type_codes,
            'objektCategories' => Objekt::$objekt_categories,
        ]);
    }

    /**
     *
     * @return DataTables
     */
    public function indexData(){
        return YajraDataTableService::ProjektTable();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => route('references.index'), 'name' => __('locale.References')],
            ['name' => __('locale.Create Reference')]
        ];


        return view('content.references.create', [
            'breadcrumbs' => $breadcrumbs,
            'countries' => Country::pluck('name', 'code'),
            'objektTypeCodes' => Objekt::$objekt_type_codes,
            'objektCategories' => Objekt::$objekt_categories,
            'projektCompetenceTypes' => Projekt::$projekt_competence_types,
            'projektConstructionTypes' => Projekt::$projekt_construction_types,
            'projektMaterialTypes' => Projekt::$projekt_material_types,
            'projektTypes' => ProjektType::pluck('name','code'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreObjektRequest  $request
     * @return JsonResponse
     */
    public function store(StoreObjektRequest $request)
    {
        $data = $request->all();
        $this->setAddressCoordinates($request, $data);
        $data['country_code'] = $data['country'];
        $objekt = new Objekt();
        $objekt->fill($data);
        $objekt->save();
        $path = str_replace(" ", "_", $objekt->country?->name);

        if($request->has('objekt_image')) {
            foreach ($request->file('objekt_image') as $key => $imagefile) {
                Image::addImage($imagefile, $path, $objekt->id, NULL, $objekt->name, $key);
            }
        }

        $surface = 0;
        if($request->has('construction')){
            foreach ($data['construction'] as $key => $field){

                $dates = !empty($data["period"][$key]) ? explode(" - ", $data["period"][$key]) : [];
                $startDate = count($dates) == 2 ? explode(".", $dates[0]) : [];
                $endDate = count($dates) == 2 ? explode(".", $dates[1]) : [];

                $projekt = [];
                $projekt['construction'] = $data["construction"][$key];
                $projekt['competence'] = $data["competence"][$key];
                $projekt['projekt_type_code'] = $data["projekt_type_code"][$key];
                $projekt['total_pools'] = $data["total_pools"][$key] ?? '0';
                $projekt['material'] = $data["material"][$key] ?? '';
                $projekt['depth_min'] = $data["depth_min"][$key] ?? 0;
                $projekt['depth_max'] = $data["depth_max"][$key] ?? 0;
                $projekt['length'] = $data["length"][$key] ?? 0;
                $projekt['width'] = $data["width"][$key] ?? 0;
                $projekt['surface'] = $data["surface"][$key] ?? 0;
                $projekt['sports_pool'] = $data["sports_pool"][$key] ?? 0;
                $projekt['arge'] = $data["arge"][$key] ?? 0;
                $projekt['ppp'] = $data["ppp"][$key] ?? 0;
                $projekt['start_month'] = count($startDate) == 2 ? $startDate[0] : NULL;
                $projekt['start_year'] = count($startDate) == 2 ? $startDate[1] : NULL;
                $projekt['end_month'] = count($endDate) == 2 ? $endDate[0] : NULL;
                $projekt['end_year'] = count($endDate) == 2 ? $endDate[1] : NULL;
                $projekt['note'] = $data["projekt_note"][$key] ?? '';
                $projekt = $objekt->projekts()->create($projekt);

                $surface += $projekt->surface;
                if(!empty($data['projekt_image'][$key])){
                    foreach ($data['projekt_image'][$key] as $k => $img) {

                        Image::addImage($img, $path, $objekt->id, $projekt->id, $objekt->name, $k);
                    }
                }
            }
        }

        $objekt->total_water_surface = $surface;
        $objekt->save();


        Session::flash('message', __('Objekt created successfully.'));
        return response()->json(['redirect' => route('references.edit', $objekt->id)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Objekt  $reference
     * @return \Illuminate\Http\Response
     */
    public function show(Objekt $reference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Objekt  $reference
     * @return View
     */
    public function edit(Objekt $reference)
    {
        $breadcrumbs = [
            ['link' => route('references.index'), 'name' => __('locale.References')],
            ['name' => __('locale.Edit Reference')]
        ];

        return view('content.references.edit', [
            'breadcrumbs' => $breadcrumbs,
            'countries' => Country::pluck('name', 'code'),
            'objektTypeCodes' => Objekt::$objekt_type_codes,
            'objektCategories' => Objekt::$objekt_categories,
            'projektCompetenceTypes' => Projekt::$projekt_competence_types,
            'projektConstructionTypes' => Projekt::$projekt_construction_types,
            'projektMaterialTypes' => Projekt::$projekt_material_types,
            'projektTypes' => ProjektType::pluck('name','code'),
            'objekt' => $reference
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateObjektRequest  $request
     * @param  \App\Models\Objekt  $reference
     * @return JsonResponse
     */
    public function update(UpdateObjektRequest $request, Objekt $reference)
    {

        $data = $request->all();
        $this->setAddressCoordinates($request, $data, $reference);
        $data['country_code'] = $data['country'];
        $reference->fill($data);
        $reference->update();
        $path = str_replace(" ", "_", $reference->country?->name);

        if($request->has('objekt_image')) {
            foreach ($request->file('objekt_image') as $key => $imagefile) {
                $referenceImage = $reference->images()->where('order',$key)->first();

                if(!empty($referenceImage)) {
                    if (Storage::disk('public')->exists($referenceImage->orig_path)) {
                        Storage::disk('public')->delete($referenceImage->orig_path);
                        Storage::disk('public')->delete($referenceImage->web_path);
                        Storage::disk('public')->delete($referenceImage->thumb_path);
                    }

                    Image::addImage($imagefile, $path, $reference->id, NULL, $reference->name, $key, $referenceImage);
                } else {
                    Image::addImage($imagefile, $path, $reference->id, NULL, $reference->name, $key);
                }
            }
        }

        $surface = 0;
        if($request->has('construction')) {
            $keys = array_keys($data['construction']);
            $reference->projekts()->whereNotIn('id',$keys)->delete();
            foreach ($data['construction'] as $key => $field) {

                $dates = !empty($data["period"][$key]) ? explode(" - ", $data["period"][$key]) : [];
                $startDate = count($dates) == 2 ? explode(".", $dates[0]) : [];
                $endDate = count($dates) == 2 ? explode(".", $dates[1]) : [];

                $projekt_data = [
                    'construction' => $data["construction"][$key],
                    'competence' => $data["competence"][$key],
                    'projekt_type_code' => $data["projekt_type_code"][$key],
                    'total_pools' => $data["total_pools"][$key] ?? '0',
                    'material' => $data["material"][$key] ?? '',
                    'depth_min' => $data["depth_min"][$key] ?? 0,
                    'depth_max' => $data["depth_max"][$key] ?? 0,
                    'length' => $data["length"][$key] ?? 0,
                    'width' => $data["width"][$key] ?? 0,
                    'surface' => $data["surface"][$key] ?? 0,
                    'sports_pool' => $data["sports_pool"][$key] ?? 0,
                    'arge' => $data["arge"][$key] ?? 0,
                    'ppp' => $data["ppp"][$key] ?? 0,
                    'start_month' => count($startDate) == 2 ? $startDate[0] : NULL,
                    'start_year' => count($startDate) == 2 ? $startDate[1] : NULL,
                    'end_month' => count($endDate) == 2 ? $endDate[0] : NULL,
                    'end_year' => count($endDate) == 2 ? $endDate[1] : NULL,
                    'note' => $data["projekt_note"][$key] ?? ''
                ];

                $projekt = $reference->projekts()->updateOrCreate(
                    ['id' => $key],
                    $projekt_data
                );

                $surface += $projekt->surface;
                if(!empty($data['projekt_image'][$key])){
                    foreach ($data['projekt_image'][$key] as $k => $img) {

                        $projektImage = $projekt->images()->where('order',$k, $key)->first();

                        if(!empty($projektImage)) {
                            if (Storage::disk('public')->exists($projektImage->orig_path)) {
                                Storage::disk('public')->delete($projektImage->orig_path);
                                Storage::disk('public')->delete($projektImage->web_path);
                                Storage::disk('public')->delete($projektImage->thumb_path);
                            }

                            Image::addImage($img, $path, $reference->id, $projekt->id, $reference->name, $k, $projektImage);
                        } else {
                            Image::addImage($img, $path, $reference->id, $projekt->id, $reference->name, $k);
                        }

                    }
                }
            }
        } else {

            $reference->projekts()->delete();
        }

        $reference->total_water_surface = $surface;
        $reference->update();

        Session::flash('message', __('Objekt updated successfully.'));
        return response()->json(['redirect' => route('references.edit', $reference->id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objekt  $reference
     * @return RedirectResponse
     */
    public function destroy(Objekt $reference)
    {
        $reference->images()->delete();
        $reference->projekts()->delete();
        $reference->delete();

        return redirect()->route('references.index')
            ->with(['message' => __('Objekt deleted successfully.')]);
    }

    /**
     * @param Request $request
     * @param array $data
     */
    public function setAddressCoordinates($request, array &$data, $objekt = false)
    {
        $recalculate = true;
        if ($objekt){
            $recalculate = $objekt->street != $request->street ||
                $objekt->postal_code != $request->postal_code ||
                $objekt->city != $request->city ||
                $objekt->country != $request->country;
        }

        if($recalculate){
            $address = $request->street . ", " . $request->postal_code . ", " . $request->city . ", " . $request->country;
            $location = Geocoder::getCoordinatesForAddress($address);

            if($location['accuracy'] == "result_not_found"){
                throw new \Exception('Address not found');
            }

            $data['latitude'] = @$location['lat'];
            $data['longitude'] = @$location['lng'];
        }
    }
}
