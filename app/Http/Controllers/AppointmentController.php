<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use App\Tables\Appointments;

/**
 * Class AppointmentController
 * @package App\Http\Controllers
 */
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('dashboard', [
            'appointments' => Appointments::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implementation for creating a new resource goes here
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
            'request_by' => auth()->user()->id,
        ]);

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param Appointment $appointment
     */
    public function show(Appointment $appointment)
    {
        // Implementation for displaying the specified resource goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Appointment $appointment
     */
    public function edit(Appointment $appointment)
    {
        // Implementation for editing the specified resource goes here
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Appointment $appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Implementation for updating the specified resource goes here
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Appointment $appointment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return redirect(route('dashboard'));
    }
}
