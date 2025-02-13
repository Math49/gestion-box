<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Gestion des Types de Contrats
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <div class="mb-6">
                    <a href="{{ route('contrat.index') }}"
                        class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ← Retour
                    </a>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier les Types de Contrats</h2>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach (['standard', 'refrigere', 'double'] as $contrat)
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800 capitalize">{{ $contrat }}</h3>
                            <a href="{{ route('contrat.edit', $contrat) }}"
                                class="mt-4 block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300 text-center">
                                ✏️ Modifier
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
