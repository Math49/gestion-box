<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des Modèles de Contrat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                
                <!-- Bouton de création -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Liste des Modèles</h2>
                    <a href="{{ route('contractModel.create') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        + Ajouter un Modèle
                    </a>
                </div>

                <!-- Tableau des modèles -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">Nom</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contract_models as $model)
                                <tr class="border border-gray-300">
                                    <td class="border border-gray-300 px-4 py-2">{{ $model->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center flex space-x-2">
                                        <a href="{{ route('contractModel.show', $model->id_contractModels) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                            Voir
                                        </a>
                                        <a href="{{ route('contractModel.edit', $model->id_contractModels) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                                            Modifier
                                        </a>
                                        <form action="{{ route('contractModel.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $model->id_contractModels }}">
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
