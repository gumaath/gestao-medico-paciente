<?php

namespace App\Http\Controllers;

use App\Models\Medic;
use App\Models\Patient;
use App\Models\Specialty;
use Illuminate\Http\Request;

/**
 * Class ResourceController
 * @package App\Http\Controllers
 */
class ResourceController extends Controller
{
    /**
     * Display the resources for managing medics.
     *
     * @return \Illuminate\View\View
     */
    public function medic()
    {
        $specialities = Specialty::all();
        return view('resources.medic', compact('specialities'));
    }

    /**
     * Display the resources for managing patients.
     *
     * @return \Illuminate\View\View
     */
    public function patient()
    {
        return view('resources.patient');
    }

    /**
     * Display the resources for managing specialties.
     *
     * @return \Illuminate\View\View
     */
    public function specialty()
    {
        return view('resources.specialty');
    }

    /**
     * Display the resources for managing administrators.
     *
     * @return \Illuminate\View\View
     */
    public function admin()
    {
        return view('resources.admin');
    }

    /**
     * Display the resources for managing appointments.
     *
     * @return \Illuminate\View\View
     */
    public function appointment()
    {
        $medics = Medic::all();
        $patients = Patient::all();
        return view('resources.appointment', compact(['patients', 'medics']));
    }
}
