<?php

namespace App\Services;

use App\Helpers\Helpers;
use App\Models\Country;
use App\Models\ExportData;
use App\Models\Objekt;
use App\Models\Projekt;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class YajraDataTableService
{
    public static function UserTable(){
        $users = User::select('id','first_name','last_name','email','created_at')->orderBy('id','asc')
            ->when(request()->has('role') && request()->filled('role'), function ($q){
                $q->whereHas('roles', function ($query){
                    $query->where('name', request()->role);
                });
            });

        return DataTables::of($users)
            ->addColumn('full_name', function($row){
                return ucwords($row->full_name);
            })
            ->addColumn('role', function($row){
                return $row->getRoleNames()->first();
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('F d, Y') . " <span class='text-muted ms-25 font-small-2'>" . $row->created_at->format('h:i a') .  "</span>";
            })
            ->addColumn('action', function($row){
                return view('content.users.action', ['user' => $row])->render();
            })
            ->rawColumns(['action', 'role', 'created_at'])
            ->make(true);
    }

    public static function ProjektTable(){

        $references = Objekt::with(['projekts.project_type','images'])->orderBy('id', 'desc')
            ->when(request()->has('category') && request()->filled('category'), function ($q){
                $q->where('category', request()->category);
            })
            ->when(request()->has('objekt_type') && request()->filled('objekt_type'), function ($q){
                $q->where('objekt_type_code', request()->objekt_type);
            })
            ->when(request()->has('country') && request()->filled('country'), function ($q){
                $q->where('country_code', request()->country);
            });

        return DataTables::of($references)
            ->addColumn('objekt_name', function($row){
                $img = Helpers::getImageSrc($row['images']->first()?->thumb_path);
                return "<div class='row'>" .
                    "<div class='col-sm-4 g-0 pe-50'>" .
                    "<img width='120' src='$img' class='img-thumbnail'>" .
                    "</div>" .
                    "<div class='col-sm-8 pt-25 g-0'>" .
                    "<a class='text-dark' href='". route('references.edit', $row->id) ."'>" .
                    "<b>" . $row['name'] ."</b>" .
                    "<span class='text-muted ms-25 font-small-2 d-block'>" .
                    "". $row['city']."" .
                    "</span>" .
                    "</a>" .
                    "</div>" .
                    "</div>";
            })
            ->addColumn('projekt_types', function($row){
                $projectType = [];
                if($row['projekts']->count()){
                    foreach($row['projekts'] as $project){
                        if(!empty($project->project_type)){
                            $projectType[] = $project->project_type->name;
                        }
                    }
                }

                return implode(", ", $projectType);
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('F d, Y') . " <span class='text-muted ms-25 font-small-2 d-blocka'>" . $row->created_at->format('h:i a') .  "</span>";
            })
            ->addColumn('competence', function($row){
                $projectCompetence = [];
                if($row['projekts']->count()){
                    foreach($row['projekts'] as $project){
                        $projectCompetence[] = '<span class="badge badge-light-danger">'.Projekt::$projekt_competence_types[$project->competence].'</span>';
                    }
                }
                return implode(' ',$projectCompetence);
            })
            ->addColumn('country', function($row){
                return  !empty($row->country) ? __('countries.'.$row->country?->name) : '';
            })
            ->addColumn('city', function($row){
                $country = !empty($row->country) ? __('countries.'.$row->country?->name) : '';
                return $row['city'] . "<div class='text-muted'>" . $country . "</div>";
            })
            ->addColumn('action', function($row){
                return view('content.references.action', ['reference' => $row])->render();
            })
            ->rawColumns(['action','objekt_name','projekt_types','created_at','competence','country','city'])
            ->make(true);
    }

    public static function ExportDataTable(){
        $exports = ExportData::latest()
            ->when(request()->has('category') && request()->filled('category'), function ($q){
                $q->where('category', request()->category);
            })
            ->when(request()->has('objekt_type') && request()->filled('objekt_type'), function ($q){
                $q->where('objekt_type_code', request()->objekt_type);
            })
            ->when(request()->has('country') && request()->filled('country'), function ($q){
                $q->where('country_code', request()->country);
            });

        return DataTables::of($exports)
            ->addColumn('name', function($row){
                $filterArr = [
                    'start_year' => $row->start_year,
                    'end_year' => $row->end_year,
                    'city' => $row->city,
                    'country' => $row->country_code,
                    'objekt_type_code' => $row->objekt_type_code,
                    'category' => $row->category,
                    'projekt_type_code' => $row->projekt_type_code,
                    'competence' => $row->competence,
                    'competition_pool' => $row->competition_pool,
                    'water_surface_type' => $row->water_surface_type,
                    'water_surface_operator' => $row->water_surface_operator,
                    'water_surface_value' => $row->water_surface_value,
                    'arge' => $row->arge,
                    'ppp' => $row->ppp,
                ];
                return  "<div class='row'>" .
                    "<div class='pt-25'>" .
                    "<b> $row->name </b>" .
                    "<span class=' text-success d-block'>" .
                    "<a class='link-success font-small-2' href='".route('exports.download.data', $filterArr)."'>" . __('XLS List') . "</a> &nbsp;" .
                    "<a href='".route('home', $filterArr)."' class=' font-small-2'>" . __('Weblink') . "</a> " .
                    "</span>" .
                    "</div>" .
                    "</div>";
            })
            ->addColumn('category', function($row){
                return !empty($row->category) ? __('locale.'. @Objekt::$objekt_categories[$row->category]) : "";
            })
            ->addColumn('city', function($row){
                $country =  !empty($row->country) ? __('countries.'.$row->country?->name) : '';
                return $row->city . "<div class='text-muted'>" . $country . "</div>";
            })
            ->addColumn('date', function($row){
                return  "<span> von $row->start_date bis $row->end_date</span>";
            })
            ->addColumn('number', function($row){
                return  "<div class='row'>" .
                    "<div class=' pt-25'>" .
                    "<b> objekte: ".$row->object_count ."</b>" .
                    "<span class='text-muted ms-25 font-small-2 d-block'>" .
                    "<b> projekte: ".$row->project_count ."</b>" .
                    "</span>" .
                    "</div>" .
                    "</div>";
            })
            ->addColumn('country', function($row){
                return  !empty($row->country) ? __('countries.'.$row->country?->name) : '';
            })
            ->addColumn('action', function($row){
                return view('content.exports.action', ['export' => $row])->render();
            })
            ->rawColumns(['action', 'name', 'category','city','date','number','country','objekt_type_code'])
            ->make(true);
    }

    public static function FilterObjektsTable($references){

        $objekt_count = $references->count();
        $references->orderBy('id', 'desc');


        $projekt_count = 0;
        foreach($references->get() as $obj){
            $projekt_count += $obj->projekts->count();
        }

        return DataTables::of($references)
            ->addColumn('name', function($row){
                return "<b>" . $row['name'] ."</b>";
            })
            ->addColumn('city', function($row){
                $country =  !empty($row->country) ? __('countries.'.$row->country?->name) : '';
                return $row['city'] . "<div class='text-muted'>" . $country. "</div>";
            })
            ->addColumn('category', function($row){
                return  "<b>". @Objekt::$objekt_categories[$row->category]."</b>";
            })
            ->addColumn('projekt_count', function($row){
                return "<b>".$row['projekts']->count()."</b>";
            })
            ->addColumn('action', function($row){
                return "<a href='". route('objekts', $row->id) ."' target='_blank'><i class='fa fa-eye' aria-hidden='true'></i></a>";
            })
            ->with(['objekt_count'=>$objekt_count, 'projekt_count' => $projekt_count])
            ->rawColumns(['action','name','projekt_count','city','category'])
            ->make(true);
    }
}
