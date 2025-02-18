<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un Modèle de Contrat
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
                <form action="{{ route('contractModel.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nom :</label>
                        <input type="text" name="name" id="name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                    </div>
                    <div class="mb-4">
                        <p class="block text-gray-700 font-medium mb-2">Variables :</p>
                        <div class="flex gap-2">
                            <p>{NOM_LOCATAIRE}</p>
                            <p>{PRENOM_LOCATAIRE}</p>
                            <p>{ADRESSE_BOX}</p>
                            <p>{DATE_DEBUT}</p>
                            <p>{DATE_FIN}</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Contenu :</label>
                        <div id="editorjs" class="px-4 py-2 border border-gray-300 rounded-lg"></div>
                        <input type="hidden" name="content" id="content">
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

    <!-- Scripts EditorJS -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
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
            onChange: async () => {
                const output = await editor.save();
                document.getElementById('content').value = JSON.stringify(output);
            }
        });
    </script>
</x-app-layout>
