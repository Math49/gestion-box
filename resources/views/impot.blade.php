<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Calcul des Déclarations Fiscales
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Entrez vos revenus pour calculer vos impôts</h2>

                <!-- Formulaire -->
                <form id="tax-form">
                    @csrf
                    <div class="mb-4">
                        <label for="total_revenue" class="block text-gray-700 font-medium mb-2">Total des revenus locatifs (€) :</label>
                        <input type="number" step="0.01" name="total_revenue" id="total_revenue" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                    </div>

                    <div class="mb-4">
                        <label for="tax_status" class="block text-gray-700 font-medium mb-2">Statut fiscal :</label>
                        <select name="tax_status" id="tax_status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300">
                            <option value="">-- Sélectionnez un statut --</option>
                            <option value="autoentrepreneur">Auto-entrepreneur (22%)</option>
                            <option value="sci">SCI (15%)</option>
                            <option value="personne_physique">Personne Physique (30%)</option>
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow transition duration-300">
                            🧮 Calculer
                        </button>
                    </div>
                </form>

                <!-- Résultats du calcul -->
                <div id="result-section" class="hidden mt-6 p-4 bg-gray-100 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Résultats :</h3>
                    <p><strong>Revenu total déclaré :</strong> <span id="result-total" class="font-bold text-blue-600"></span> €</p>
                    <p><strong>Taux d'imposition :</strong> <span id="result-rate" class="font-bold text-red-600"></span> %</p>
                    <p><strong>Montant estimé des impôts :</strong> <span id="result-tax" class="font-bold text-red-600"></span> €</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Script pour soumettre le formulaire via AJAX -->
    <script>
        document.getElementById('tax-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('tax.calculate') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('result-section').classList.remove('hidden');
                document.getElementById('result-total').textContent = data.totalRevenue;
                document.getElementById('result-rate').textContent = data.taxRate;
                document.getElementById('result-tax').textContent = data.taxAmount;
            })
            .catch(error => console.error("Erreur lors du calcul des impôts :", error));
        });
    </script>

</x-app-layout>
