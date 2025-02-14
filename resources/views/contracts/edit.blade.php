<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier un Contrat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">

                <form action="{{ route('contract.update', $contract->id_contract) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Sélection du Locataire -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Locataire :</label>
                            <select name="id_tenant" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                                @foreach ($tenants as $tenant)
                                    <option value="{{ $tenant->id_tenant }}"
                                        {{ $tenant->id_tenant == $contract->id_tenant ? 'selected' : '' }}>
                                        {{ $tenant->name }} {{ $tenant->firstname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dates -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Date de Début :</label>
                            <input type="date" name="date_start" value="{{ $contract->date_start }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Date de Fin :</label>
                            <input type="date" name="date_end" value="{{ $contract->date_end }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Prix Mensuel (€) :</label>
                            <input type="number" name="monthly_price" value="{{ $contract->monthly_price }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('contract.index') }}"
                            class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                            Annuler
                        </a>
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                            ✅ Modifier
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
