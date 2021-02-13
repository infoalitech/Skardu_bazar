<?php

namespace App\Http\Controllers;

use App\Models\AvailableItem;
use Illuminate\Http\Request;

class AvailableItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.item.available_model');

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
     * @param  \App\Models\AvailableItem  $availableItem
     * @return \Illuminate\Http\Response
     */
    public function show(AvailableItem $availableItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AvailableItem  $availableItem
     * @return \Illuminate\Http\Response
     */
    public function edit(AvailableItem $availableItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AvailableItem  $availableItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AvailableItem $availableItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AvailableItem  $availableItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(AvailableItem $availableItem)
    {
        //
    }
}
