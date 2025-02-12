<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('box.add') }}" class="btn btn-primary mb-4">Créer une nouvelle box</a>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tigh">Vos boxs</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if ($boxs)
                            @foreach ($boxs as $box)
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        <h4>{{ $box->Nom }}</h4>
                                        <p>{{ $box->Prix }}€</p>
                                        <p>{{ $box->Type }}</p>
                                        <a href="{{route('box.view', $box->ID_box)}}" class="text-blue-500">Voir</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Vous n'avez pas encore de box</p>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
