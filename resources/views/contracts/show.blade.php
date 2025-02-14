<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails du Contrat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">

                <!-- Détails du contrat -->
                <h2 class="text-2xl font-semibold text-gray-800">Contrat pour le box : {{ $contract->box->name }}</h2>
                <p><strong>Locataire :</strong> {{ $contract->tenant->name }} {{ $contract->tenant->firstname }}</p>
                <p><strong>Date de début :</strong> {{ $contract->date_start }}</p>
                <p><strong>Date de fin :</strong> {{ $contract->date_end }}</p>
                <p><strong>Prix Mensuel :</strong> {{ $contract->monthly_price }}€</p>

                <!-- Factures associées -->
                <h3 class="text-xl font-semibold text-gray-800 mt-6">Factures Générées</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border border-gray-300 mt-2">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">Période</th>
                                <th class="border border-gray-300 px-4 py-2">Montant (€)</th>
                                <th class="border border-gray-300 px-4 py-2">Date de Paiement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $bill)
                                <tr class="border border-gray-300">
                                    <td class="border border-gray-300 px-4 py-2">{{ $bill->period_number }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $bill->payement_price }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $bill->payement_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-between">
                    <a href="{{ route('contract.index') }}"
                        class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                        Retour
                    </a>
                    <a href="{{ route('contract.edit', $contract->id_contract) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                        Modifier le Contrat
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
