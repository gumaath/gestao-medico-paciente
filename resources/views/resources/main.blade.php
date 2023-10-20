<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastros') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @auth
                        @if (auth()->user()->admin)
                            <Link href="{{ url('resource/medic') }}"
                                class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 mx-4 border border-gray-400 rounded shadow">
                            Cadastrar médico
                            </Link>
                            <Link href="{{ url('resource/patient') }}"
                                class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 mx-4 border border-gray-400 rounded shadow">
                            Cadastrar paciente
                            </Link>
                            <Link href="{{ url('resource/specialty') }}"
                                class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 mx-4 border border-gray-400 rounded shadow">
                            Cadastrar especialidade
                            </Link>
                            <Link href="{{url('resource/admin') }}"
                                class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 mx-4 border border-gray-400 rounded shadow">
                            Cadastrar administrador
                            </Link>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
                        <div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
