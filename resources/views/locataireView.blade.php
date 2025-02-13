<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Gestion des locataires
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">

                <!-- Bouton "Créer un locataire" -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Liste des locataires</h2>
                    <a href="{{ route('locataire.create') }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        + Créer un locataire
                    </a>
                </div>

                @if ($locataires->isEmpty())
                    <p class="text-gray-500">Aucun locataire trouvé.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">Nom</th>
                                    <th class="border border-gray-300 px-4 py-2">Prénom</th>
                                    <th class="border border-gray-300 px-4 py-2">Téléphone</th>
                                    <th class="border border-gray-300 px-4 py-2">Email</th>
                                    <th class="border border-gray-300 px-4 py-2">Box Loué</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locataires as $locataire)
                                    <tr class="border border-gray-300">
                                        <td class="border border-gray-300 px-4 py-2">{{ $locataire->Nom }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $locataire->Prenom }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $locataire->Telephone }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $locataire->Email }}</td>

                                        <!-- Sélection de la box -->
                                        <td class="border border-gray-300 px-4 py-2">
                                            <form action="{{ route('locataire.updateBox', $locataire->ID_locataire) }}"
                                                method="POST" class="flex space-x-2 gap-4">
                                                @csrf
                                                @method('PUT')
                                                <select name="ID_box"
                                                    class="border border-gray-300 rounded px-2 py-1 focus:ring focus:ring-blue-300">
                                                    <option value="">Aucun</option>
                                                    @foreach ($boxs as $box)
                                                        <option value="{{ $box->ID_box }}"
                                                            {{ $box->ID_locataire == $locataire->ID_locataire ? 'selected' : '' }}
                                                            {{ $box->ID_locataire ? 'disabled class=text-gray-400' : '' }}>
                                                            {{ $box->Nom }} - {{ $box->Adresse }}
                                                            @if ($box->ID_locataire)
                                                                (Loué)
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>


                                                <!-- Bouton de validation -->
                                                <button type="submit"
                                                    class="!bg-blue-600 hover:!bg-blue-700 !text-white font-semibold !px-4 !py-2 !rounded-md transition duration-300">
                                                    Modifier
                                                </button>
                                            </form>
                                        </td>

                                        <!-- Bouton Modifier -->
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <a href=""
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                                ✏️ Modifier
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
