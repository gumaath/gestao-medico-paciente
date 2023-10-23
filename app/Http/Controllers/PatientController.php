<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class PatientController
 * @package App\Http\Controllers
 */
class PatientController extends Controller
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
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'cpf' => ['required', 'string', 'max:14'],
            'telephones' => ['required'],
            'cep' => ['required', 'string', 'max:8'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        Patient::create([
            'user_id' => $user->id,
            'cpf' => $request->cpf,
            'telephones' => json_encode($request->telephones),
            'cep' => $request->cep,
            'address' => $request->address,
            'number_address' => $request->number_address,
            'responsable_cpf' => $request->responsable_cpf ?: null,
            'responsable_name' => $request->responsable_name ?: null,
        ]);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param Patient $patient
     */
    public function show(Patient $patient)
    {
        // Implementation for displaying the specified resource goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Patient $patient
     */
    public function edit(Patient $patient)
    {
        // Implementation for showing the form to edit the specified resource goes here
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Patient $patient
     */
    public function update(Request $request, Patient $patient)
    {
        // Implementation for updating the specified resource in storage goes here
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Patient $patient
     */
    public function destroy(Patient $patient)
    {
        // Implementation for removing the specified resource from storage goes here
    }

    /**
     * Check the patient's birthdate and determine if they are a minor.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkPatientBirthdate(Request $request)
    {
        $patient = Patient::where('id', $request->patient)->first();

        if (!$patient) {
            return response()->json(['error' => 'Patient not found']);
        }

        $birthdate = $patient->user->birthdate; // Adjust this to match your database field name

        // Perform logic to check the patient's age based on their birthdate
        $isMinor = $this->isMinor($birthdate);

        return response()->json(['isMinor' => $isMinor]);
    }

    /**
     * Determine if a person is a minor based on their birthdate.
     *
     * @param string $birthdate
     * @return bool
     */
    private function isMinor($birthdate)
    {
        $birthdate = \Carbon\Carbon::parse($birthdate);
        $today = \Carbon\Carbon::now();
        $age = $birthdate->diffInYears($today);

        return $age < 12;
    }
}
