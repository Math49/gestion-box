<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un Box
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

                <form action="{{ route('box.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-gray-700 font-medium mb-2">Nom :</label>
                            <input type="text" name="name" id="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label for="address" class="block text-gray-700 font-medium mb-2">Adresse :</label>
                            <input type="text" name="address" id="address" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label for="description" class="block text-gray-700 font-medium mb-2">Description :</label>
                            <textarea name="description" id="description" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300"></textarea>
                        </div>

                        <div>
                            <label for="price" class="block text-gray-700 font-medium mb-2">Prix (€) :</label>
                            <input type="number" name="price" id="price" required step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-blue-600 hover:!bg-blue-700 text-white font-semibold !px-6 !py-3 rounded-lg transition duration-300">
                            ✅ Ajouter Box
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
