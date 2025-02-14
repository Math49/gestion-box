<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un Locataire
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
                <form action="{{ route('tenant.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nom :</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Prénom :</label>
                            <input type="text" name="firstname" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email :</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Téléphone :</label>
                            <input type="text" name="phone" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Adresse :</label>
                            <input type="text" name="address" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-blue-600 hover:!bg-blue-700 text-white font-semibold !px-6 !py-3 rounded-lg transition duration-300">
                            ✅ Ajouter
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
