<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Bienvenue sur votre tableau de bord</h2>

                <!-- Menu de Navigation -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('box.index') }}" class="block bg-blue-500 hover:bg-blue-600 text-white text-center font-semibold px-6 py-4 rounded-lg shadow-md transition duration-300">
                        📦 Gérer les Box
                    </a>
                    <a href="{{ route('contract.index') }}" class="block bg-green-500 hover:bg-green-600 text-white text-center font-semibold px-6 py-4 rounded-lg shadow-md transition duration-300">
                        📜 Gérer les Contrats
                    </a>
                    <a href="{{ route('tenant.index') }}" class="block bg-yellow-500 hover:bg-yellow-600 text-white text-center font-semibold px-6 py-4 rounded-lg shadow-md transition duration-300">
                        👥 Gérer les Locataires
                    </a>
                    <a href="{{ route('contractModel.index') }}" class="block bg-purple-500 hover:bg-purple-600 text-white text-center font-semibold px-6 py-4 rounded-lg shadow-md transition duration-300">
                        📝 Modèles de Contrats
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
