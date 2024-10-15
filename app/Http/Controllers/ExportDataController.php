<?php

namespace App\Http\Controllers;

use App\Exports\ReferencesExport;
use App\Helpers\Helpers;
use App\Models\Country;
use App\Models\ExportData;
use App\Http\Requests\StoreExportDataRequest;
use App\Http\Requests\UpdateExportDataRequest;
use App\Http\Requests\FilterExportDataRequest;
use App\Models\Objekt;
use App\Models\Projekt;
use App\Models\ProjektType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use App\Services\YajraDataTableService;

class ExportDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => \request()->url(), 'name' => __('locale.Data Export')],
            ['name' => __('locale.Index')]
        ];

        return view('content.exports.index', [
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
        return YajraDataTableService::ExportDataTable();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => route('exports.index'), 'name' => __('Data Export')],
            ['name' => __('locale.Create')]
        ];

        return view('content.exports.create', [
            'breadcrumbs' => $breadcrumbs,
            'countries' => Country::pluck('name', 'code'),
            'objektTypeCodes' => Objekt::$objekt_type_codes,
            'objektCategories' => Objekt::$objekt_categories,
            'projektCompetenceTypes' => Projekt::$projekt_competence_types,
            'projektTypes' => ProjektType::pluck('name','code'),
            'water_surface_operators' => ExportData::$water_surface_operators
        ]);
    }

    /**
     *
     * @return DataTables
     */
    public function filterObjekts(FilterExportDataRequest $request){
        $references = Helpers::filterReferences($request);
        return YajraDataTableService::FilterObjektsTable($references);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExportDataRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreExportDataRequest $request)
    {
        $ExportData = new ExportData();
        $exportData = $request->all();
        $exportData['country_code'] = $exportData['country'];
        $ExportData->fill($exportData);
        $ExportData->save();

        return redirect()->route('exports.edit',$ExportData->id)->with(['message' => __('Export created successfully.')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExportData  $exportData
     * @return \Illuminate\Http\Response
     */
    public function show(ExportData $exportData)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExportData  $exportData
     * @return View
     */
    public function edit(ExportData $export)
    {
        $breadcrumbs = [
            ['link' => route('exports.index'), 'name' => __('locale.Data Export')],
            ['name' => __('locale.Edit')]
        ];

        return view('content.exports.edit', [
            'breadcrumbs' => $breadcrumbs,
            'countries' => Country::pluck('name', 'code'),
            'objektTypeCodes' => Objekt::$objekt_type_codes,
            'objektCategories' => Objekt::$objekt_categories,
            'projektCompetenceTypes' => Projekt::$projekt_competence_types,
            'projektTypes' => ProjektType::pluck('name','code'),
            'water_surface_operators' => ExportData::$water_surface_operators,
            'export' => $export,
            'weblink' => route('home', [
                'start_year' => $export->start_year,
                'end_year' => $export->end_year,
                'city' => $export->city,
                'country' => $export->country_code,
                'objekt_type_code' => $export->objekt_type_code,
                'category' => $export->category,
                'projekt_type_code' => $export->projekt_type_code,
                'competence' => $export->competence,
                'competition_pool' => $export->competition_pool,
                'water_surface_type' => $export->water_surface_type,
                'water_surface_operator' => $export->water_surface_operator,
                'water_surface_value' => $export->water_surface_value,
                'arge' => $export->arge,
                'ppp' => $export->ppp,
            ])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExportDataRequest  $request
     * @param  \App\Models\ExportData  $exportData
     * @return RedirectResponse
     */
    public function update(UpdateExportDataRequest $request, ExportData $export)
    {

        $exportData = $request->all();
        $exportData['country_code'] = $exportData['country'];
        $export->fill($exportData);
        $export->update();

        return redirect()->route('exports.edit',$export->id)->with(['message' => __('Export updated successfully.')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ExportData $export
     * @return RedirectResponse
     */
    public function destroy(ExportData $export)
    {
        $export->delete();

        return redirect()->route('exports.index')
            ->with(['message' => __('Export deleted successfully.')]);
    }

    public function exportReferences(FilterExportDataRequest $request){
            $references = Helpers::filterReferences($request);
            $fileName = 'references_'.date('Y-m-d H:i:s').'.xlsx';
            return Excel::download(new ReferencesExport($references->get()),$fileName);
    }
}
