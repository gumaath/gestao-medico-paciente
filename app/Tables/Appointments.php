<?php

namespace App\Tables;

use App\Models\Appointment;
use App\Models\Specialty;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Appointments extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {

        $user = auth()->user();
        $medic = $user->medic;

        if ($user->admin) {
            $query = Appointment::query()
                ->select('appointments.*', 'medics.crm', 'users1.name', 'users2.name', 'specialties.name')
                ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                ->join('medics', 'appointments.medic_id', '=', 'medics.id')
                ->join('users as users1', 'patients.user_id', '=', 'users1.id')
                ->join('users as users2', 'medics.user_id', '=', 'users2.id')
                ->join('specialties', 'medics.specialty_id', '=', 'specialties.id');

            return QueryBuilder::for($query)
                ->allowedFilters(['patient.user.name'])
                ->allowedSorts(['appointment_date'])
                ->defaultSort('appointment_date')
                ->paginate();
        } else if ($medic) {
            $query = Appointment::where('medic_id', $medic->id)
                ->select('appointments.*', 'users.name as patient_name')
                ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                ->join('users', 'patients.user_id', '=', 'users.id');

            return QueryBuilder::for($query)
                ->allowedFilters(['patient.user.name'])
                ->allowedSorts(['appointment_date'])
                ->defaultSort('appointment_date')
                ->paginate();
        } else {
            $patient = $user->patient;

            $query = Appointment::where('patient_id', $patient->id)
                ->select('appointments.*', 'users.name', 'medics.crm', 'specialties.name')
                ->join('medics', 'appointments.medic_id', '=', 'medics.id')
                ->join('users', 'medics.user_id', '=', 'users.id')
                ->join('specialties', 'medics.specialty_id', '=', 'specialties.id');

            return QueryBuilder::for($query)
                ->allowedFilters(['medic.specialty.name', 'medic.user.name', 'medic.crm', AllowedFilter::exact('medic.specialty_id')])
                ->allowedSorts(['appointment_date'])
                ->defaultSort('appointment_date')
                ->paginate();
        }
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {

        $user = auth()->user();
        $medic = $user->medic;

        if ($user->admin) {
            $table
            ->column('id', 'ID')
            ->column('patient.user.name', 'Nome do Paciente')
            ->column('medic.user.name', 'Nome do Médico')
            ->column('medic.specialty.name', 'Especialidade')
            ->column('medic.crm', 'CRM')
            ->column('appointment_date', 'Data da Consulta')
            ->column('created_at', 'Data do agendamento')
            ->column('--', canBeHidden: false);
        } else if ($medic) {
            $table
                ->column('patient.user.name', 'Nome do Paciente', searchable: true)
                ->column('appointment_date', 'Data da Consulta', sortable: true)
                ->column('created_at', 'Data do agendamento')
                ->column('--', canBeHidden: false);
        } else {
            $patient = $user->patient;

                if ($patient->checkPatientBirthdate()) {
                    $specialities = Specialty::find(1);
                    $specialities = [$specialities->id => $specialities->name];
                }
                else
                    $specialities = Specialty::all()->pluck('name', 'id')->toArray();

            $table
                ->column('medic.user.name', 'Nome do Médico', searchable: true)
                ->column('medic.crm', 'CRM', searchable: true, hidden: true)
                ->column('medic.specialty.name', 'Especialidade')
                ->column('appointment_date', 'Data da Consulta', sortable: true)
                ->column('created_at', 'Data do agendamento')
                ->selectFilter('medic.specialty_id', $specialities, 'Especialidade');
        }
    }
}
