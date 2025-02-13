<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Ajouter un locataire
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

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ajouter un nouveau locataire</h2>

                <form action="{{ route('locataire.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label for="nom" class="block text-gray-700 font-medium mb-2">Nom:</label>
                            <input type="text" name="nom" id="nom"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Prénom -->
                        <div>
                            <label for="prenom" class="block text-gray-700 font-medium mb-2">Prénom:</label>
                            <input type="text" name="prenom" id="prenom"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Adresse -->
                        <div class="sm:col-span-2">
                            <label for="adresse" class="block text-gray-700 font-medium mb-2">Adresse:</label>
                            <input type="text" name="adresse" id="adresse"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label for="telephone" class="block text-gray-700 font-medium mb-2">Téléphone:</label>
                            <input type="text" name="telephone" id="telephone"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email:</label>
                            <input type="email" name="email" id="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Bancaire -->
                    </div>
                    <div>
                        <label for="bancaire" class="block text-gray-700 font-medium mb-2">Données bancaires:</label>
                        <input type="bancaire" name="bancaire" id="bancaire"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                            required>
                    </div>

                    <!-- Bouton -->
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-blue-600 hover:!bg-blue-700 !text-white font-semibold !px-6 !py-3 !rounded-lg shadow-md transition duration-300">
                            Ajouter le locataire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
