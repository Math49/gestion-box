<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des Contrats
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                
                <!-- Bouton de création -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Liste des Contrats</h2>
                    <a href="{{ route('contract.create') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        + Ajouter un Contrat
                    </a>
                    <a href="{{ route('export.payments') }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        📥 Export Paiements (Excel)
                    </a>

                </div>

                <!-- Tableau des contrats -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">Box</th>
                                <th class="border border-gray-300 px-4 py-2">Locataire</th>
                                <th class="border border-gray-300 px-4 py-2">Début</th>
                                <th class="border border-gray-300 px-4 py-2">Fin</th>
                                <th class="border border-gray-300 px-4 py-2">Prix Mensuel (€)</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $contract)
                                <tr class="border border-gray-300">
                                    <td class="border border-gray-300 px-4 py-2">{{ $contract->box->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $contract->tenant->name }} {{ $contract->tenant->firstname }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $contract->date_start }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $contract->date_end }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $contract->monthly_price }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center flex space-x-2">
                                        <a href="{{ route('contract.show', $contract->id_contract) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                            Voir
                                        </a>
                                        <a href="{{ route('contract.edit', $contract->id_contract) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                            Modifier
                                        </a>
                                        <form action="{{ route('contract.destroy', $contract->id_contract) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_contract" value="{{ $contract->id_contract }}">
                                            <button type="submit"
                                                class="!bg-red-500 hover:!bg-red-600 text-white font-semibold !px-4 !py-2 rounded-md shadow transition duration-300">
                                                Supprimer
                                            </button>
                                        </form>
                                        <a href="{{ route('contract.downloadpdf', $contract->id_contract) }}"
                                            class="bg-blue-400 hover:bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg transition duration-300">
                                            Télécharger le PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
