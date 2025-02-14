<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un Contrat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">

                <form action="{{ route('contract.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Sélection du Box -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Box :</label>
                            <select name="id_box" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                                <option value="">Sélectionnez un box</option>
                                @foreach ($boxes as $box)
                                    <option value="{{ $box->id_box }}">{{ $box->name }} ({{$box->price}}€)</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sélection du Locataire -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Locataire :</label>
                            <select name="id_tenant" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                                <option value="">Sélectionnez un locataire</option>
                                @foreach ($tenants as $tenant)
                                    <option value="{{ $tenant->id_tenant }}">{{ $tenant->name }} {{ $tenant->firstname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sélection du Modèle de Contrat -->
                        <div class="sm:col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Modèle de Contrat :</label>
                            <select name="id_contract_model" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                                <option value="">Sélectionnez un modèle de contrat</option>
                                @foreach ($contract_models as $model)
                                    <option value="{{ $model->id_contractModels }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dates -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Date de Début :</label>
                            <input type="date" name="date_start" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Date de Fin :</label>
                            <input type="date" name="date_end" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Prix Mensuel (€) :</label>
                            <input type="number" name="monthly_price" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300"
                                >
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-blue-600 hover:!bg-blue-700 text-white font-semibold !px-6 !py-3 rounded-lg transition duration-300">
                            ✅ Ajouter le Contrat
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
