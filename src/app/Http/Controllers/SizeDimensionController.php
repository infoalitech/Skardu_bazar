<?php

namespace App\Http\Controllers;

use App\Models\SizeDimension;
use Illuminate\Http\Request;

class SizeDimensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.item.sizedimension');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SizeDimension  $sizeDimension
     * @return \Illuminate\Http\Response
     */
    public function show(SizeDimension $sizeDimension)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SizeDimension  $sizeDimension
     * @return \Illuminate\Http\Response
     */
    public function edit(SizeDimension $sizeDimension)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SizeDimension  $sizeDimension
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SizeDimension $sizeDimension)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SizeDimension  $sizeDimension
     * @return \Illuminate\Http\Response
     */
    public function destroy(SizeDimension $sizeDimension)
    {
        //
    }
}
