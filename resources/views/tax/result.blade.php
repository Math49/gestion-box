<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Résultats de l'Impôt
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Résultat de la Déclaration</h2>

                <div class="mb-4">
                    <p><strong>Revenus locatifs déclarés :</strong> {{ number_format($totalIncome, 2, ',', ' ') }} €</p>
                    <p><strong>Régime choisi :</strong> {{ $regime === 'micro-foncier' ? 'Micro-foncier (30% abattement)' : 'Régime Réel (100% imposable)' }}</p>
                    <p><strong>Montant imposable :</strong> {{ number_format($taxableIncome, 2, ',', ' ') }} €</p>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('tax.download', ['total_income' => $totalIncome, 'taxable_income' => $taxableIncome, 'regime' => $regime]) }}"
                       class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                        📄 Télécharger en PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
