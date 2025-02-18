<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Déclaration aux Impôts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Calcul de l'Impôt Locatif</h2>

                <form action="{{ route('tax.calculate') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="total_income" class="block text-gray-700 font-medium mb-2">
                            Montant total des revenus locatifs payés cette année (€)
                        </label>
                        <input type="number" name="total_income" id="total_income" step="0.01" value="{{ $totalIncome }}" readonly
                               class="w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-lg focus:ring-2 focus:ring-blue-300">
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                            ✅ Calculer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
