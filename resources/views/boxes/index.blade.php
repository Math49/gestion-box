<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des Box
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                
                <!-- Bouton de création -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Liste des Box</h2>
                    <a href="{{ route('box.create') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        + Ajouter un Box
                    </a>
                </div>

                <!-- Tableau des box -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">Nom</th>
                                <th class="border border-gray-300 px-4 py-2">Adresse</th>
                                <th class="border border-gray-300 px-4 py-2">Prix (€)</th>
                                <th class="border border-gray-300 px-4 py-2">Statut</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($boxes as $box)
                                @php
                                    $contract = optional($box->contracts)->isNotEmpty()
                                        ? $box->contracts->where('date_end', '>=', now())->first()
                                        : null;

                                    $tenant = optional($contract)->tenant;
                                @endphp
                                <tr class="border border-gray-300">
                                    <td class="border border-gray-300 px-4 py-2">{{ $box->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $box->address }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $box->price }} €</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        @if ($contract)
                                            <span class="text-green-600 font-semibold">Loué</span>
                                        @else
                                            <span class="text-gray-500 font-semibold">Disponible</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-center flex space-x-2">
                                        <a href="{{ route('box.show', $box->id_box) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                            Voir
                                        </a>
                                        <a href="{{ route('box.edit', $box->id_box) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                            Modifier
                                        </a>
                                        <form action="{{ route('box.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_box" value="{{ $box->id_box }}">
                                            <button type="submit"
                                                class="!bg-red-500 hover:!bg-red-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
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
