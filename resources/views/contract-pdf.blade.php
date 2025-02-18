<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat - {{ $contract->tenant->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
        h1, h2, h3 {
            text-align: center;
        }
        .contract-info {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .contract-content {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <h1>Contrat de Location</h1>
    <h3>Référence: #{{ $contract->id_contract }}</h3>
    <hr>

    <div class="contract-info">
        <h2>Informations du Locataire</h2>
        <p><strong>Nom :</strong> {{ $contract->tenant->name }} {{ $contract->tenant->firstname }}</p>
        <p><strong>Adresse :</strong> {{ $contract->tenant->address }}</p>
        <p><strong>Téléphone :</strong> {{ $contract->tenant->phone }}</p>
        <p><strong>Email :</strong> {{ $contract->tenant->email }}</p>
    </div>

    <div class="contract-info">
        <h2>Informations du Box</h2>
        <p><strong>Nom :</strong> {{ $contract->box->name }}</p>
        <p><strong>Adresse :</strong> {{ $contract->box->address }}</p>
        <p><strong>Prix mensuel :</strong> {{ number_format($contract->monthly_price, 2, ',', ' ') }} €</p>
    </div>

    <div class="contract-info">
        <h2>Durée du Contrat</h2>
        <p><strong>Date de début :</strong> {{ \Carbon\Carbon::parse($contract->date_start)->format('d/m/Y') }}</p>
        <p><strong>Date de fin :</strong> {{ \Carbon\Carbon::parse($contract->date_end)->format('d/m/Y') }}</p>
    </div>

    <div class="contract-content">
        <h2>Contenu du Contrat</h2>
        {!! $htmlContent !!}
    </div>

</body>
</html>
