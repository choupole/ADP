<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <style>
        /* Ajoutez votre mise en page CSS pour la facture ici */
        /* Par exemple, définissez les styles pour l'en-tête, le corps, la table, etc. */
    </style>
</head>
<body>
    <h1>Facture</h1>
    
    <p><strong>Propriétaire :</strong> {{ $paiement->proprietaire->nom }} {{ $paiement->proprietaire->postnom }} {{ $paiement->proprietaire->prenom }}</p>
    <p><strong>Adresse du propriétaire :</strong> Av/{{ $paiement->proprietaire->avenue }} N°{{ $paiement->proprietaire->numeroPar }},Q/{{ $paiement->proprietaire->quartier }},C/{{ $paiement->proprietaire->commune }}</p>
    <p><strong>Adresse de la parcelle :</strong> Av/{{ $paiement->parcelle->avenue }} N°{{ $paiement->parcelle->numeroPar }},Q/{{ $paiement->parcelle->quartier }},C/{{ $paiement->parcelle->commune }}</p>
    <p><strong>Montant :</strong> {{ $paiement->montant }}</p>
    <p><strong>Date de Paiement :</strong> {{ $paiement->datePaie }}</p>
</body>
</html>