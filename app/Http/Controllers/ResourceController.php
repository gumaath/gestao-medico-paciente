<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function medic()
    {
        return view('resources.medic');
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
