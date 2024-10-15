<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    //
    public function swap($locale){
        // available language in template array
        $availLocale=['en'=>'en', 'fr'=>'fr','de'=>'de','pt'=>'pt'];
        $user = Auth::user();
        // check for existing language
        if(array_key_exists($locale,$availLocale)){
            session()->put('locale',$locale);
            $user->lang = $locale;
            $user->save();
        }
        return redirect()->back();
    }
}
