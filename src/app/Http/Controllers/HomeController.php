<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home()
    {
        //
        return view('welcome');
    }
    public function getapp()
    {
        //
        return view('getapp');
    }
    public function help()
    {
        //
        return view('help');
    }
    public function services()
    {
        //
        return view('services');
    }
}
