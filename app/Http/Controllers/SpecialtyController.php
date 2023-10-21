<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

/**
 * Class SpecialtyController
 * @package App\Http\Controllers
 */
class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Implementation for displaying a listing of resources goes here
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implementation for showing the form to create a new resource goes here
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Specialty::create([
            'name' => $request->name,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Specialty $specialty
     */
    public function show(Specialty $specialty)
    {
        // Implementation for displaying the specified resource goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Specialty $specialty
     */
    public function edit(Specialty $specialty)
    {
        // Implementation for showing the form to edit the specified resource goes here
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Specialty $specialty
     */
    public function update(Request $request, Specialty $specialty)
    {
        // Implementation for updating the specified resource in storage goes here
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Specialty $specialty
     */
    public function destroy(Specialty $specialty)
    {
        // Implementation for removing the specified resource from storage goes here
    }
}
