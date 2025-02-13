<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Modifier la box
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <!-- Bouton retour -->
                <div class="mb-6">
                    <a href="{{ route('box.view', $box->ID_box) }}"
                        class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ← Retour
                    </a>
                </div>

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier les informations</h2>

                <form action="{{ route('box.update', $box->ID_box) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label for="name" class="block text-gray-700 font-medium mb-2">Nom:</label>
                            <input type="text" name="name" id="name" value="{{ $box->Nom }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Adresse -->
                        <div>
                            <label for="address" class="block text-gray-700 font-medium mb-2">Adresse:</label>
                            <input type="text" name="address" id="address" value="{{ $box->Adresse }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Prix -->
                        <div>
                            <label for="price" class="block text-gray-700 font-medium mb-2">Prix (€):</label>
                            <input type="number" name="price" id="price" value="{{ $box->Prix }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                        </div>

                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-gray-700 font-medium mb-2">Type:</label>
                            <select name="type" id="type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>
                                <option value="standard" {{ $box->Type == 'standard' ? 'selected' : '' }}>Standard
                                </option>
                                <option value="refrigere" {{ $box->Type == 'refrigere' ? 'selected' : '' }}>Réfrigéré
                                </option>
                                <option value="double" {{ $box->Type == 'double' ? 'selected' : '' }}>Double</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="sm:col-span-2">
                            <label for="description" class="block text-gray-700 font-medium mb-2">Description:</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                                required>{{ $box->Description }}</textarea>
                        </div>
                    </div>

                    <!-- Bouton -->
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-blue-600 hover:!bg-blue-700 !text-white font-semibold !px-6 !py-3 !rounded-lg !shadow-md transition duration-300">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
