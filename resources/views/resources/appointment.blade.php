@extends('resources.main')

@section('content')
    <div class="m-6">
        <h2>Cadastro de Agendamento</h2>
        <form method="POST" action="{{ route('register.appointment') }}">
            @csrf
            <input type="hidden" name="resource" value="true">

            <!-- Especialidade -->
            <div class="mt-4">
                <x-input-label for="patient" :value="__('Paciente')" />
                <select name="patient" id="patient"
                    class="w-full bg-white border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-400">
                    <option value="" disabled selected>Paciente</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('specialty')" class="mt-2" />
            </div>

            <!-- Especialidade -->
            <div class="mt-4">
                <x-input-label for="medic" :value="__('Médico')" />
                <select name="medic" id="medic"
                    class="w-full bg-white border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-400">
                    <option value="" disabled selected>Médico</option>
                    @foreach ($medics as $medic)
                        <option value="{{ $medic->id }}">{{ $medic->user->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('specialty')" class="mt-2" />
            </div>

            <!-- Data de Nascimento -->
            <div class="mt-4">
                <x-input-label for="date" :value="__('Data da Consulta')" />
                <x-text-input id="date" class="block mt-1 w-full" type="dateTime-local" name="date"
                    :value="old('date')" required autocomplete="date" />
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>

            <div class="flex items-center mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
    <script type="module">
        $(document).ready(function() {

            $('#medic').select2();
            $('#patient').select2();
        });

        $('#patient').on('change', function() {
            const patient = $(this).val();


            // Send an AJAX request to check the patient's birthdate
            $.ajax({
                url: '/check-patient-birthdate',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    patient: patient
                },
                success: function(response) {
                    if (response.isMinor) {
                        // The patient is a minor, so search for medics with the specified specialty
                        $.ajax({
                            url: '/search-pediatric-medics',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                // Clear existing options
                                $('#medic').empty();

                                // Add new options based on the data
                                data.medics.forEach(function(item) {
                                    $('#medic').append($('<option>', {
                                        value: item.value,
                                        text: item.medic
                                    }));
                                });
                            },
                            error: function(error) {
                                // Handle errors
                            }
                        });
                    }
                },
                error: function(error) {
                    // Handle errors
                }
            });
        });
    </script>
@endsection
