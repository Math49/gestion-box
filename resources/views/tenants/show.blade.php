<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails du Locataire
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('tenant.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ← Retour à la liste
                    </a>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $tenant->name }} {{ $tenant->firstname }}</h2>

                <p class="mt-2"><strong>Email :</strong> {{ $tenant->email }}</p>
                <p><strong>Téléphone :</strong> {{ $tenant->phone }}</p>
                <p><strong>Adresse :</strong> {{ $tenant->address }}</p>

                @if ($contract && $box)
                    <p class="mt-4 text-green-600 font-semibold">Box Loué : {{ $box->name }}</p>
                @else
                    <p class="mt-4 text-gray-500">Aucun box loué.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
