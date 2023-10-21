<?php

namespace App\Http\Controllers;

use App\Models\Medic;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class TypeController
 * @package App\Http\Controllers
 */
class TypeController extends Controller
{
    /**
     * Create a new patient and associate them with a user.
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patient(User $user, Request $request)
    {
        Patient::create([
            'user_id' => $user->id,
            'cpf' => $request->cpf,
            'telephones' => json_encode($request->telephones),
            'cep' => $request->cep,
            'address' => $request->address,
            'number_address' => $request->number_address,
        ]);

        return redirect('/dashboard');
    }

    /**
     * Create a new medic and associate them with a user.
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function medic(User $user, Request $request)
    {
        Medic::create([
            'user_id' => $user->id,
            'crm' => $request->crm,
            'specialty_id' => $request->specialty,
        ]);

        return redirect('/dashboard');
    }

    /**
     * Create a new admin user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function admin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthdate' => ['required', 'date'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'admin' => 1,
        ]);

        return redirect('/dashboard');
    }
}
