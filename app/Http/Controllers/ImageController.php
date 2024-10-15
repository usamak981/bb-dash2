<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Image;
use App\Models\Objekt;
use App\Models\Projekt;
use App\Models\ProjektType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => \request()->url(), 'name' => __('locale.Images')],
            ['name' => __('locale.Index')]
        ];


        $images = Image::with('projekt', 'objekt')
            ->has('objekt')
            ->where(function($q){
                $q->whereNull('projekt_id')
                ->orWhereHas('projekt');
            })
            ->when($request->has('projekt_type') && $request->projekt_type != "all",
                function ($query) use ($request) {
                    $query->whereHas('projekt', function ($q) use ($request){
                        $q->where('projekt_type_code', $request->projekt_type);
                    });
                })
            ->when($request->has('country') && $request->country != "all",
                function ($query) use ($request) {
                    $query->whereHas('objekt', function ($q) use ($request){
                        $q->where('country_code', $request->country);
                    });
                })
            ->when($request->has('objekt_type') && $request->objekt_type != "all",
                function ($query) use ($request) {
                    $query->whereHas('objekt', function ($q) use ($request){
                        $q->where('objekt_type_code', $request->objekt_type);
                    });
                })
            ->when($request->has('category') && $request->category != "all",
                function ($query) use ($request) {
                    $query->whereHas('objekt', function ($q) use ($request){
                        $q->where('category', $request->category);
                    });
                })
            ->when($request->has('search') && $request->filled('search'),
                function ($query) use ($request){
                    $query->where('description', 'like', "%" . $request->search . "%");
                    $query->orWhere('copyright', 'like', "%" . $request->search . "%");
                    $query->orWhereHas('objekt', function($query) use ($request) {
                        $query->where('name', 'like', "%" . $request->search . "%");
                    });
                });


        //dd($images->toSql());

        return view('content.images.index', [
            'breadcrumbs' => $breadcrumbs,
            'images' => $images->latest()->paginate(12),
            'countries' => Country::pluck('name','code'),
            'categories' => Objekt::$objekt_categories,
            'objektTypes' => Objekt::$objekt_type_codes,
            'projektTypes' => ProjektType::pluck('name','code'),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return RedirectResponse
     */
    public function update(Request $request, Image $picture)
    {
        $request->validate(['description' => 'required|max:255']);

        $picture->fill($request->all());
        $picture->save();

        return back()->with('message', __('Image updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $picture
     * @return RedirectResponse
     */
    public function destroy(Image $picture)
    {
        $picture->delete();
        return redirect()->route('pictures.index')->with(['message' => __('Image deleted successfully')]);
    }
}
