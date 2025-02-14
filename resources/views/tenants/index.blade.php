<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des Locataires
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                
                <!-- Bouton de création -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Liste des Locataires</h2>
                    <a href="{{ route('tenant.create') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        + Ajouter un Locataire
                    </a>
                </div>

                <!-- Tableau des locataires -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">Nom</th>
                                <th class="border border-gray-300 px-4 py-2">Prénom</th>
                                <th class="border border-gray-300 px-4 py-2">Email</th>
                                <th class="border border-gray-300 px-4 py-2">Téléphone</th>
                                <th class="border border-gray-300 px-4 py-2">Box Loué</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant)
                                @php
                                    $contract = $contracts->where('id_tenant', $tenant->id_tenant)->first();
                                    $box = optional($contract)->box;
                                @endphp
                                <tr class="border border-gray-300">
                                    <td class="border border-gray-300 px-4 py-2">{{ $tenant->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $tenant->firstname }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $tenant->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $tenant->phone }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        @if ($box)
                                            <span class="text-green-600 font-semibold">{{ $box->name }}</span>
                                        @else
                                            <span class="text-gray-500 font-semibold">Aucun</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-center flex space-x-2">
                                        <a href="{{ route('tenant.show', $tenant->id_tenant) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                            Voir
                                        </a>
                                        <a href="{{ route('tenant.edit', $tenant->id_tenant) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                            Modifier
                                        </a>
                                        <form action="{{ route('tenant.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_tenant" value="{{ $tenant->id_tenant }}">
                                            <button type="submit"
                                                class="!bg-red-500 hover:!bg-red-600 text-white font-semibold !px-4 !py-2 rounded-md shadow transition duration-300">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
