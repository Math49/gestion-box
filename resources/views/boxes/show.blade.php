<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails du Box
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">

                <!-- Bouton retour -->
                <div class="mb-6">
                    <a href="{{ route('box.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ← Retour à la liste
                    </a>
                </div>

                <!-- Informations du Box -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ $box->name }}</h2>

                <p><strong>Adresse :</strong> {{ $box->address }}</p>
                <p><strong>Description :</strong> {{ $box->description }}</p>
                <p><strong>Prix :</strong> {{ $box->price }} €</p>

                <!-- Vérifier si un contrat est actif -->
                @if ($contract)
                    <div class="mt-6 p-4 border-l-4 border-green-500 bg-green-100">
                        <h3 class="text-lg font-semibold text-green-700">Statut : Loué</h3>
                        <p><strong>Locataire :</strong> {{ $tenant->firstname }} {{ $tenant->name }}</p>
                        <p><strong>Email :</strong> {{ $tenant->email }}</p>
                        <p><strong>Téléphone :</strong> {{ $tenant->phone }}</p>
                        <p><strong>Contrat :</strong> du {{ \Carbon\Carbon::parse($contract->date_start)->format('d/m/Y') }} 
                            au {{ \Carbon\Carbon::parse($contract->date_end)->format('d/m/Y') }}</p>
                    </div>
                @else
                    <div class="mt-6 p-4 border-l-4 border-gray-500 bg-gray-100">
                        <h3 class="text-lg font-semibold text-gray-700">Statut : Disponible</h3>
                        <p>Ce box n'est pas actuellement loué.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
