<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ajoutez une box</h2>

                <form action="{{ route('box.create') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label for="name" class="block text-gray-700 font-medium mb-2">Nom:</label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Adresse -->
                        <div>
                            <label for="address" class="block text-gray-700 font-medium mb-2">Adresse:</label>
                            <input type="text" name="address" id="address"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Prix -->
                        <div>
                            <label for="price" class="block text-gray-700 font-medium mb-2">Prix (€):</label>
                            <input type="number" name="price" id="price" min="0" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-gray-700 font-medium mb-2">Type de contrat:</label>
                            <select name="type" id="type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                                <option value="">Sélectionnez un type</option>

                                @foreach ($typesContrat as $type)
                                    <option value="{{ $type->ID_type }}">{{ $type->nom }}</option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Description -->
                        <div class="sm:col-span-2">
                            <label for="description" class="block text-gray-700 font-medium mb-2">Description:</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required></textarea>
                        </div>
                    </div>

                    <!-- Bouton -->
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-blue-500 hover:!bg-blue-700 text-white font-semibold !px-6 !py-3 !rounded-lg !shadow-md !transition !duration-300">
                            Ajouter la box
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
