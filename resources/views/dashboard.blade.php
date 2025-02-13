<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                <a href="{{ route('box.add') }}"
                    class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 transition duration-300 mb-4">
                    + Créer une nouvelle box
                </a>

                <h2 class="font-semibold text-2xl text-gray-800 mb-6">Vos boxs de conddd</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if ($boxs)
                        @foreach ($boxs as $box)
                            <div
                                class="bg-white shadow-md rounded-xl overflow-hidden p-6 border border-gray-200 
                                        hover:shadow-lg hover:scale-105 transition-transform duration-300">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-lg font-semibold text-gray-700 mb-2">{{ $box->Nom }}</h4>
                                            <div class="mb-4">
                                                @if ($box->ID_locataire)
                                                    <span class="inline-block bg-red-500 text-white text-sm font-semibold px-3 py-1 rounded-full">
                                                        Loué
                                                    </span>
                                                @else
                                                    <span class="inline-block bg-green-500 text-white text-sm font-semibold px-3 py-1 rounded-full">
                                                        Libre
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-gray-600">💰 <span class="font-medium">{{ $box->Prix }}€</span></p>
                                        <p class="text-gray-600">📦 <span class="font-medium">{{ $box->Type }}</span></p>
                                        
                                        <div class="mt-4">
                                    <a href="{{ route('box.view', $box->ID_box) }}"
                                        class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 transition duration-300">
                                        Voir
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">Vous n'avez pas encore de box</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
