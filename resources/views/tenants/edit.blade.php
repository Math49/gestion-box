<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier un Locataire
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
                <form action="{{ route('tenant.update', $tenant->id_tenant) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nom :</label>
                            <input type="text" name="name" value="{{ $tenant->name }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Prénom :</label>
                            <input type="text" name="firstname" value="{{ $tenant->firstname }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email :</label>
                            <input type="email" name="email" value="{{ $tenant->email }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Téléphone :</label>
                            <input type="text" name="phone" value="{{ $tenant->phone }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Adresse :</label>
                            <input type="text" name="address" value="{{ $tenant->address }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <!-- Bouton Annuler -->
                        <a href="{{ route('tenant.index') }}"
                            class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                            Annuler
                        </a>

                        <!-- Bouton Modifier -->
                        <button type="submit"
                            class="!bg-yellow-500 hover:!bg-yellow-600 text-white font-semibold !px-6 !py-3 rounded-lg transition duration-300">
                            ✅ Modifier
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
