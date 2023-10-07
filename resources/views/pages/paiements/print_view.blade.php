<!-- print_view.blade.php -->
<html>
<head>
    <title>Impression de la facture</title>
</head>
<body>
    <!-- Inclure le contenu HTML de la facture -->
    {!! $html !!}
    
    <!-- Ajouter un bouton pour ouvrir l'interface d'impression -->
    <button onclick="printInvoice()">Imprimer</button>

    <script>
        function printInvoice() {
            // Ouvrir l'interface d'impression
            window.print();
        }
    </script>
</body>
</html>