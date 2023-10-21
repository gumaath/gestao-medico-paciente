<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use App\Tables\Appointments;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('dashboard', [
            'appointments' => Appointments::class
        ]);
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
    public function store(Request $request)
    {
        $request->validate([
            'patient' => ['required'],
            'medic' => ['required'],
            'date' => ['required'],
        ]);

        Appointment::create([
            'patient_id' => $request->patient,
            'medic_id' => $request->medic,
            'appointment_date' => $request->date,
            'request_by' => auth()->user()->id
        ]);

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {

        $this->authorize('delete', $appointment);

        $appointment->delete();

        return redirect(route('dashboard'));
    }
}
