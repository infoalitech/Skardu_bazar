<?php

namespace App\Http\Controllers;

use App\Models\CustomerRanking;
use Illuminate\Http\Request;

class CustomerRankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.customer.ranking');

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
     * @param  \App\Models\CustomerRanking  $customerRanking
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerRanking $customerRanking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerRanking  $customerRanking
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerRanking $customerRanking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerRanking  $customerRanking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerRanking $customerRanking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerRanking  $customerRanking
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerRanking $customerRanking)
    {
        //
    }
}
