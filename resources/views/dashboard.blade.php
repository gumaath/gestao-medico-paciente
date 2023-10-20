<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @auth
                        @if (auth()->user()->admin)
                            <button
                                class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 mx-4 border border-gray-400 rounded shadow">
                                Cadastrar médico
                            </button>
                            <button
                                class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 mx-4 border border-gray-400 rounded shadow">
                                Cadastrar paciente
                            </button>
                            <button
                                class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 mx-4 border border-gray-400 rounded shadow">
                                Cadastrar especialidade
                            </button>
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
                    <x-splade-table :for="$appointments" striped>
                        @cell('--', $appointment)
                            <form method="POST" action="{{ route('appointments.destroy', $appointment) }}">
                                @csrf
                                @method('delete')
                                <x-dropdown-link :href="route('appointments.destroy', $appointment)"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Excluir') }}
                                </x-dropdown-link>
                            </form>
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
