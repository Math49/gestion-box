<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Détails du locataire
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <!-- Bouton retour -->
                <div class="mb-6">
                    <a href="{{ route('locataire') }}"
                        class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ← Retour
                    </a>
                </div>

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informations du locataire</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-lg font-medium text-gray-700"><strong>Nom :</strong> {{ $locataire->Nom }}</p>
                        <p class="text-lg font-medium text-gray-700"><strong>Prénom :</strong> {{ $locataire->Prenom }}</p>
                        <p class="text-lg font-medium text-gray-700"><strong>Téléphone :</strong> {{ $locataire->Telephone }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700"><strong>Email :</strong> {{ $locataire->Email }}</p>
                        <p class="text-lg font-medium text-gray-700"><strong>Adresse :</strong> {{ $locataire->Adresse }}</p>
                    </div>
                </div>

                <!-- Section Informations Bancaires -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Informations Bancaires</h3>
                    <p class="text-lg font-medium text-gray-700"><strong>Compte bancaire :</strong> {{ $locataire->bancaire }}</p>
                </div>

                <!-- Box Loué -->
                @if($locataire->boxs->isNotEmpty())
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Box Loué</h3>
                        @foreach ($locataire->boxs as $box)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <p class="text-lg font-medium text-gray-700"><strong>Nom :</strong> {{ $box->Nom }}</p>
                                <p class="text-lg font-medium text-gray-700"><strong>Adresse :</strong> {{ $box->Adresse }}</p>
                                <p class="text-lg font-medium text-gray-700"><strong>Type :</strong> {{ $box->Type }}</p>
                                <p class="text-lg font-medium text-gray-700"><strong>Prix :</strong> {{ $box->Prix }}€</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-6 text-gray-500">Ce locataire n'a pas encore de box loué.</p>
                @endif

                <!-- Bouton Modifier -->
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('locataire.edit', $locataire->ID_locataire) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
                        ✏️ Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
