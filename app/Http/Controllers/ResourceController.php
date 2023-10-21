<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function medic()
    {
        $specialities = Specialty::all();
        return view('resources.medic', compact('specialities'));
    }

    public function patient()
    {
        return view('resources.patient');
    }

    public function specialty()
    {
        return view('resources.specialty');
    }

    public function admin()
    {
        return view('resources.admin');
    }
}
