<?php

namespace App\Http\Controllers;

use App\Models\Medic;
use Illuminate\Http\Request;

/**
 * Class MedicController
 * @package App\Http\Controllers
 */
class MedicController extends Controller
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
        // Implementation for storing a newly created resource in storage goes here
    }

    /**
     * Display the specified resource.
     *
     * @param Medic $medic
     */
    public function show(Medic $medic)
    {
        // Implementation for displaying the specified resource goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Medic $medic
     */
    public function edit(Medic $medic)
    {
        // Implementation for showing the form to edit the specified resource goes here
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Medic $medic
     */
    public function update(Request $request, Medic $medic)
    {
        // Implementation for updating the specified resource in storage goes here
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Medic $medic
     */
    public function destroy(Medic $medic)
    {
        // Implementation for removing the specified resource from storage goes here
    }

    /**
     * Search for pediatric medics and return them as JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPediatricMedics()
    {
        $medics = Medic::where('specialty_id', 1)
            ->with('user') // Eager load the User relationship
            ->get();

        $medicNames = $medics->map(function ($medic) {
            return [
                'value' => $medic->id,
                'medic' => $medic->user->name,
            ];
        });

        return response()->json(['medics' => $medicNames]);
    }
}
