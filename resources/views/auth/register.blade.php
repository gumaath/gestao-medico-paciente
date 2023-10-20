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
            <x-input-label for="CPF" :value="__('CPF')" />
            <x-text-input id="CPF" class="block mt-1 w-full" type="text" name="CPF" :value="old('CPF')"
                required autocomplete="CPF" />
            <x-input-error :messages="$errors->get('CPF')" class="mt-2" />
        </div>

        <!-- Data de Nascimento -->
        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Data de Nascimento')" />
            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')"
                required autocomplete="birthdate" />
            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
        </div>

        <!-- Telefones -->
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Telefones (máximo 3)')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <!-- CEP -->
        <div class="mt-4">
            <x-input-label for="CEP" :value="__('CEP')" />
            <x-text-input id="CEP" class="block mt-1 w-full" type="text" name="CEP" :value="old('CEP')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('cep')" class="mt-2" />
        </div>

        <!-- Endereço -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Endereço')" />
            <x-text-input disabled id="address" class="block mt-1 w-full" type="text" name="address"
                :value="old('address')" required autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Número da casa -->
        <div class="mt-4">
            <x-input-label for="address_number" :value="__('Número')" />
            <x-text-input id="address_number" class="block mt-1 w-full" type="text" name="address_number"
                :value="old('address_number')" required autocomplete="address_number" />
            <x-input-error :messages="$errors->get('address_number')" class="mt-2" />
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
<script type="module">
    $(document).ready(function($) {
        $('#CPF').mask('000.000.000-00', {
            reverse: true
        });
        $('#CEP').mask('00000000', {
            reverse: true
        });
        $('#telephone').mask('(99) 9 9999-9999, (99) 9 9999-9999, (99) 9 9999-9999');

    });

    // Function to update the #address field
    function updateAddressField(cep, number) {
        var addressElement = $('#address');
        $('#address').val('...');

        axios.get("https://viacep.com.br/ws/" + cep + "/json/")
            .then(response => {
                if (response.data.logradouro) {
                    $('#address').val(response.data.logradouro + ', ' + number + ' - ' + response.data.localidade +
                        ' - ' + response.data.uf);
                } else if (response.data.erro) {
                    addressElement.val('');
                    alert('Insira um CEP válido!');
                }
            })
            .catch(error => {
                // Handle any network or other errors
                addressElement.val('');
                alert('Insira um CEP válido!');
            });;
    }

    // Event listener for #CEP blur
    $('#CEP').blur(function() {
        if ($(this).val().length == 8) {
            var cep = $(this).val().replace(/\D/g, '');
            var number = $('#address_number').val();

            updateAddressField(cep, number);
        }
    });

    // Event listener for #number_address
    $('#address_number').blur(function() {
        var cep = $('#CEP').val().replace(/\D/g, '');
        var number = $(this).val();

        updateAddressField(cep, number);
    });
</script>
