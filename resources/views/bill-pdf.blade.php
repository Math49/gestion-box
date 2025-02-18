<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Facture #{{ $bill->id_bill }}</h1>
    
    <p><strong>Prix :</strong> {{ $bill->payement_price }} €</p>
    <p><strong>Date de création :</strong> {{ $bill->creation_date }}</p>
    <p><strong>Date de paiement :</strong>
        @if($bill->payement_date)
            {{ $bill->payement_date }}
        @else
            Non payée
        @endif
    </p>
    <p><strong>Numéro de période :</strong> {{ $bill->period_number }}</p>

    <h2>Informations du Contrat</h2>
    <p><strong>Locataire :</strong> {{ $bill->contract->tenant->name }} {{ $bill->contract->tenant->firstname }}</p>
    <p><strong>Box :</strong> {{ $bill->contract->box->name }}</p>

</body>
</html>
