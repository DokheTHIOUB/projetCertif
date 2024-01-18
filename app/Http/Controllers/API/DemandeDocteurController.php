<?php

namespace App\Http\Controllers;

use App\Models\DemandeDocteur;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreDemandeDocteurRequest;
use App\Http\Requests\UpdateDemandeDocteurRequest;

class DemandeDocteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDemandeDocteurRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DemandeDocteur $demandeDocteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemandeDocteur $demandeDocteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandeDocteurRequest $request, DemandeDocteur $demandeDocteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DemandeDocteur $demandeDocteur)
    {
        //
    }
}
