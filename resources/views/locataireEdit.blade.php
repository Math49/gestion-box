<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Modifier les informations du locataire
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <!-- Bouton retour -->
                <div class="mb-6">
                    <a href="{{ route('locataire.view', $locataire->ID_locataire) }}"
                        class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ← Retour
                    </a>
                </div>

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier les informations du locataire</h2>

                <form action="{{ route('locataire.update', $locataire->ID_locataire) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label for="nom" class="block text-gray-700 font-medium mb-2">Nom:</label>
                            <input type="text" name="nom" id="nom" value="{{ $locataire->Nom }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Prénom -->
                        <div>
                            <label for="prenom" class="block text-gray-700 font-medium mb-2">Prénom:</label>
                            <input type="text" name="prenom" id="prenom" value="{{ $locataire->Prenom }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Adresse -->
                        <div class="sm:col-span-2">
                            <label for="adresse" class="block text-gray-700 font-medium mb-2">Adresse:</label>
                            <input type="text" name="adresse" id="adresse" value="{{ $locataire->Adresse }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email:</label>
                            <input type="email" name="email" id="email" value="{{ $locataire->Email }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Téléphone -->

                        <div>
                            <label for="telephone" class="block text-gray-700 font-medium mb-2">Téléphone:</label>
                            <input type="tel" name="telephone" id="telephone" value="{{ $locataire->Telephone }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Informations Bancaires -->
                        <div>
                            <label for="bancaire" class="block text-gray-700 font-medium mb-2">Données bancaire:</label>
                            <input type="text" name="bancaire" id="bancaire" value="{{ $locataire->bancaire }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>
                    </div>

                    <!-- Bouton -->
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-blue-600 hover:!bg-blue-700 !text-white font-semibold !px-6 !py-3 rounded-lg shadow-md transition duration-300">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
