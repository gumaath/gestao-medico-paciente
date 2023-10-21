@extends('resources.main')

@section('content')
<div class="m-6">
    <h2>Cadastro de Especialidade</h2>
    <form method="POST" action="{{ route('register.speciality') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4">
            <x-primary-button class="ml-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>

    </form>

</div>
@endsection
