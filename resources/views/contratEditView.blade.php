<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Modifier le Contrat : {{ ucfirst($contratType) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">

                <div class="mb-6">
                    <a href="{{ route('contrat.types') }}"
                        class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ← Retour
                    </a>
                </div>

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier le Contenu du Contrat</h2>

                <p class="text-gray-600 mb-4">Utilisez les placeholders suivants :</p>
                <ul class="list-disc list-inside text-gray-700 mb-4">
                    <li><strong>{NOM_LOCATAIRE}</strong> - Nom du locataire</li>
                    <li><strong>{PRENOM_LOCATAIRE}</strong> - Prénom du locataire</li>
                    <li><strong>{ADRESSE_BOX}</strong> - Adresse du box</li>
                    <li><strong>{DATE_DEBUT}</strong> - Date de début</li>
                    <li><strong>{DATE_FIN}</strong> - Date de fin</li>
                </ul>

                <form action="{{ route('contrat.update', $contratType) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <textarea name="contenu" rows="10"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300">{{ $contenu }}</textarea>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-blue-600 hover:!bg-blue-700 !text-white font-semibold !px-6 !py-3 !rounded-lg shadow-md transition duration-300">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
