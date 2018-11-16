<?php

namespace App\Http\Controllers;

class CatalogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the catalog dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('catalog');
    }
}
