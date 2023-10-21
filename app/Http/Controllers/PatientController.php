<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
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
            'number_address' => $request->number_address
        ]);


        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }

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

    private function isMinor($birthdate)
    {
        $birthdate = \Carbon\Carbon::parse($birthdate);
        $today = \Carbon\Carbon::now();
        $age = $birthdate->diffInYears($today);

        return $age < 12;
    }
}
