@vite(['resources/js/forms.js'])
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')"
                required autocomplete="cpf" />
            <x-input-error :messages="$errors->get('CPF')" class="mt-2" />
        </div>

        <!-- Data de Nascimento -->
        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Data de Nascimento')" />
            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')"
                required autocomplete="birthdate" />
            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
        </div>

         <!-- Responsable CPF (initially hidden) -->
         <div class="mt-4" id="responsable-cpf-field" style="display: none;">
            <x-input-label for="responsable_cpf" :value="__('CPF do Responsável')" />
            <x-text-input id="responsable_cpf" class="block mt-1 w-full" type="text" name="responsable_cpf"
                :value="old('responsable_cpf')" autocomplete="responsable_cpf" />
            <x-input-error :messages="$errors->get('responsable_cpf')" class="mt-2" />
        </div>

        <!-- Responsable Name (initially hidden) -->
        <div class="mt-4" id="responsable-name-field" style="display: none;">
            <x-input-label for="responsable_name" :value="__('Nome do Responsável')" />
            <x-text-input id="responsable_name" class="block mt-1 w-full" type="text" name="responsable_name"
                :value="old('responsable_name')" autocomplete="responsable_name" />
            <x-input-error :messages="$errors->get('responsable_name')" class="mt-2" />
        </div>

        <!-- Telefones -->
        <div class="mt-4">
            <x-input-label for="telephones" :value="__('Telefones (máximo 3)')" />
            <x-text-input id="telephones" class="block mt-1 w-full" type="text" name="telephones" :value="old('telephones')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('telephones')" class="mt-2" />
        </div>

        <!-- CEP -->
        <div class="mt-4">
            <x-input-label for="cep" :value="__('CEP')" />
            <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" :value="old('cep')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('cep')" class="mt-2" />
        </div>

        <!-- Endereço -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Endereço')" />
            <x-text-input readonly id="address" class="block mt-1 w-full" type="text" name="address"
                :value="old('address')" required autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Número da casa -->
        <div class="mt-4">
            <x-input-label for="number_address" :value="__('Número')" />
            <x-text-input id="number_address" class="block mt-1 w-full" type="text" name="number_address"
                :value="old('number_address')" required autocomplete="number_address" />
            <x-input-error :messages="$errors->get('number_address')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirme sua senha')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Já tenho conta') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
