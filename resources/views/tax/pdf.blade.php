<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déclaration d'Impôts</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .container { width: 100%; max-width: 800px; margin: auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 15px; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Déclaration d'Impôts - Revenus Locatifs</h2>
        </div>

        <div class="section">
            <p><span class="bold">Revenus locatifs déclarés :</span> {{ number_format($total_income, 2, ',', ' ') }} €</p>
            <p><span class="bold">Régime choisi :</span> {{ $regime === 'micro-foncier' ? 'Micro-foncier (30% abattement)' : 'Régime Réel (100% imposable)' }}</p>
            <p><span class="bold">Montant imposable :</span> {{ number_format($taxable_income, 2, ',', ' ') }} €</p>
        </div>

        <div class="section">
            <p><span class="bold">Signature :</span> _____________________</p>
        </div>
    </div>
</body>
</html>
