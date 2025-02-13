<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <!-- Bouton retour -->
                <div class="flex justify-between items-center">
                    <div class="mb-6">
                        <a href="/dashboard"
                            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                            ← Retour
                        </a>
                    </div>
                    <div class="mb-6">
                        <a href="{{ route('box.edit', $box->ID_box) }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                            Edit
                        </a>
                    </div>
                </div>

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Détails de la box</h2>

                <!-- Statut de la box -->
                <div class="mb-4">
                    @if ($box->ID_locataire)
                        <span class="inline-block bg-red-500 text-white text-sm font-semibold px-3 py-1 rounded-full">
                            Loué
                        </span>
                    @else
                        <span class="inline-block bg-green-500 text-white text-sm font-semibold px-3 py-1 rounded-full">
                            Libre
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-lg font-medium text-gray-700">📦 <strong>Nom :</strong> {{ $box->Nom }}</p>
                        <p class="text-lg font-medium text-gray-700">📍 <strong>Adresse :</strong> {{ $box->Adresse }}
                        </p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">💰 <strong>Prix :</strong> {{ $box->Prix }}€</p>
                        <p class="text-lg font-medium text-gray-700">🛠 <strong>Type :</strong> {{ $box->Type }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <p class="text-lg font-medium text-gray-700"><strong>📝 Description :</strong></p>
                    <p class="text-gray-600 bg-gray-100 p-4 rounded-lg">{{ $box->Description }}</p>
                </div>
            </div>
            <div>
            @if ($box->ID_locataire)
                <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200 mt-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Détails du locataire</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-lg font-medium text-gray-700">👤 <strong>Nom :</strong> {{ $locataire->Nom }} {{$locataire->Prenom}}</p>
                            <p class="text-lg font-medium text-gray-700">📍 <strong>Adresse :</strong> {{ $locataire->Adresse }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-medium text-gray-700">📞 <strong>Téléphone :</strong> {{ $locataire->Telephone }}</p>
                            <p class="text-lg font-medium text-gray-700">✉️ <strong>Email :</strong> {{ $locataire->Email }}</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <p class="text-lg font-medium text-gray-700"><strong>💳 Données bancaires :</strong></p>
                        <p class="text-gray-600 bg-gray-100 p-4 rounded-lg">{{ $locataire->bancaire }}</p>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</x-app-layout>
