<?php

namespace App\Http\Controllers;

use App\Models\Docteur;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreDocteurRequest;
use App\Http\Requests\UpdateDocteurRequest;

class DocteurController extends Controller
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
    public function store(Docteur $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Docteur $docteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docteur $docteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocteurRequest $request, Docteur $docteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docteur $docteur)
    {
        //
    }
}
