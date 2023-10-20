<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $user = auth()->user();
        $medic = $user->medic;

        if ($medic) {
            $columns = array('Nome do paciente', 'Data da consulta');

            $appointments = Appointment::where('medic_id', $medic->id)->get();

            $formattedAppointments = $appointments->map(function ($appointment) {
                return [
                    'patient_name' => $appointment->patient->user->name,
                    'appointment_date' => $appointment->appointment_date
                ];
            });
        }
        else {
            $patient = $user->patient;

            $columns = array('Nome do médico', 'Especialidade', 'Data da consulta');


            $appointments = Appointment::where('patient_id', $patient->id)->get();

             $formattedAppointments = $appointments->map(function ($appointment) {
                return [
                    'medic_name' => $appointment->medic->user->name,
                    'specialty_name' => $appointment->medic->specialty->name,
                    'appointment_date' => $appointment->appointment_date
                ];
            });
        }

        return view('dashboard', [
            'appointments' => SpladeTable::for($formattedAppointments->all()),
            'columns' => $columns
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointments)
    {
        //
    }
}
