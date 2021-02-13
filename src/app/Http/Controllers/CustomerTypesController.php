<?php

namespace App\Http\Controllers;

use App\Models\CustomerTypes;
use Illuminate\Http\Request;

class CustomerTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.customer.type');

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
     * @param  \App\Models\CustomerTypes  $customerTypes
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerTypes $customerTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerTypes  $customerTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerTypes $customerTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerTypes  $customerTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerTypes $customerTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerTypes  $customerTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerTypes $customerTypes)
    {
        //
    }
}
