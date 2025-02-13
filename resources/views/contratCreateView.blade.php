<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Création d'un Contrat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">

                <!-- Bouton retour -->
                <div class="mb-6">
                    <a href="{{ route('contrat.index') }}"
                        class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ← Retour
                    </a>
                </div>

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Créer un nouveau contrat</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>⚠️ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contrat.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Sélection du box -->
                        <div>
                            <label for="ID_box" class="block text-gray-700 font-medium mb-2">Box :</label>
                            <select name="ID_box" id="ID_box" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <option value="">-- Sélectionner un box --</option>
                                @foreach ($boxs as $box)
                                    <option value="{{ $box->ID_box }}">{{ $box->Nom }} - {{ $box->Adresse }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sélection du locataire -->
                        <div>
                            <label for="ID_locataire" class="block text-gray-700 font-medium mb-2">Locataire :</label>
                            <select name="ID_locataire" id="ID_locataire" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <option value="">-- Sélectionner un locataire --</option>
                                @foreach ($locataires as $locataire)
                                    <option value="{{ $locataire->ID_locataire }}">{{ $locataire->Nom }} {{ $locataire->Prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date de début -->
                        <div>
                            <label for="Date_debut" class="block text-gray-700 font-medium mb-2">Date de début :</label>
                            <input type="date" name="Date_debut" id="Date_debut" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        </div>

                        <!-- Date de fin -->
                        <div>
                            <label for="Date_fin" class="block text-gray-700 font-medium mb-2">Date de fin :</label>
                            <input type="date" name="Date_fin" id="Date_fin" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                        </div>
                    </div>

                    <!-- Bouton de validation -->
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-blue-600 hover:!bg-blue-700 text-white font-semibold !px-6 !py-3 rounded-lg shadow-md transition duration-300">
                            ✅ Créer le contrat
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
