<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Liste des Contrats
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">

                <!-- En-tête avec bouton de gestion des types de contrats -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Vos Box et Contrats</h2>
                    <a href="{{ route('contrat.types') }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ⚙️ Gérer les Types de Contrats
                    </a>
                    <a href="{{ route('contrat.create') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        Créer un contrat
                    </a>
                </div>

                @if ($boxs->isEmpty())
                    <p class="text-gray-500">Aucun box enregistré.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">Nom du Box</th>
                                    <th class="border border-gray-300 px-4 py-2">Type</th>
                                    <th class="border border-gray-300 px-4 py-2">Locataire</th>
                                    <th class="border border-gray-300 px-4 py-2">Début</th>
                                    <th class="border border-gray-300 px-4 py-2">Fin</th>
                                    <th class="border border-gray-300 px-4 py-2">Status</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($boxs as $box)
                                    @if ($contrats->where('ID_box', $box->ID_box)->isNotEmpty())
                                        @foreach ($contrats->where('ID_box', $box->ID_box) as $contrat)
                                            <tr class="border border-gray-300">
                                                <!-- Nom du box -->
                                                <td class="border border-gray-300 px-4 py-2">{{ $box->Nom }}</td>

                                                <!-- Type du box -->
                                                <td class="border border-gray-300 px-4 py-2 capitalize">{{ $box->Type }}</td>

                                                <!-- Locataire -->
                                                <td class="border border-gray-300 px-4 py-2">
                                                    {{ $contrat->locataire ? $contrat->locataire->Nom . ' ' . $contrat->locataire->Prenom : 'Non attribué' }}
                                                </td>

                                                <!-- Date de début -->
                                                <td class="border border-gray-300 px-4 py-2">{{ $contrat->Date_debut }}</td>

                                                <!-- Date de fin -->
                                                <td class="border border-gray-300 px-4 py-2">{{ $contrat->Date_fin }}</td>

                                                <!-- Status du contrat -->
                                                <td class="border border-gray-300 px-4 py-2 capitalize">
                                                    {{ $contrat->Status }}
                                                </td>

                                                <!-- Actions -->
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <a href="{{ route('contrat.download', $contrat->ID_contrat) }}"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                                        📄 Télécharger TXT
                                                    </a>
                                                </td>                                                
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="border border-gray-300 bg-gray-50">
                                            <td class="border border-gray-300 px-4 py-2">{{ $box->Nom }}</td>
                                            <td class="border border-gray-300 px-4 py-2 capitalize">{{ $box->Type }}</td>
                                            <td class="border border-gray-300 px-4 py-2">Aucun locataire</td>
                                            <td class="border border-gray-300 px-4 py-2">-</td>
                                            <td class="border border-gray-300 px-4 py-2">-</td>
                                            <td class="border border-gray-300 px-4 py-2">Aucun contrat</td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <span class="text-gray-400">Pas de contrat</span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
