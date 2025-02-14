<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier un Modèle de Contrat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">

                <div class="mb-6">
                    <a href="{{ route('contractModel.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold px-4 py-2 rounded-md shadow transition duration-300">
                        ← Retour à la liste
                    </a>
                </div>

                <!-- Formulaire -->
                <form action="{{ route('contractModel.update', $contract_model->id_contractModels) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nom :</label>
                        <input type="text" name="name" id="name" value="{{ $contract_model->name }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Contenu :</label>
                        <div id="editorjs" class="px-4 py-2 border border-gray-300 rounded-lg"></div>
                        <input type="hidden" name="content" id="content">
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="!bg-yellow-500 hover:!bg-yellow-600 text-white font-semibold !px-6 !py-3 rounded-lg transition duration-300">
                            ✅ Modifier
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Scripts EditorJS -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>

    <script>
        const editor = new EditorJS({
            holder: 'editorjs',
            tools: {
                header: {
                    class: Header,
                    inlineToolbar: true
                },
                table: {
                    class: Table,
                    inlineToolbar: true
                },
                quote: {
                    class: Quote,
                    inlineToolbar: true
                },
                code: {
                    class: CodeTool,
                    inlineToolbar: false
                }
            },
            data: {!! $contract_model->content !!},
            onChange: async () => {
                const output = await editor.save();
                document.getElementById('content').value = JSON.stringify(output);
            }
        });
    </script>
</x-app-layout>
