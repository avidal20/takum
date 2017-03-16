<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App;
use Redirect;
use Session;

class LanguageController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cod)
    {

        if(!Session::has('locale')){
          Session::put('locale', $cod);
        }else{
          Session::put('locale', $cod);
        }

        return Redirect::back();
    }
}
