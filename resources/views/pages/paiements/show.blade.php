@extends('layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Détails du Paiement</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('paiements.index') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('paiements.show', $paiement->id) }}">Détails du Paiement</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $paiement->id }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="" onclick="printContent()" class="btn btn-primary" >Imprimer</a>
                </div>
            </div>
        </div>
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <h4 class="text-blue h4">Détails du Paiement</h4>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <p><strong>Propriétaire :</strong> {{ $paiement->proprietaire->nom }} {{ $paiement->proprietaire->postnom }} {{ $paiement->proprietaire->prenom }}</p>
                    <p><strong>Adresse du propriétaire :</strong> Av/{{ $paiement->proprietaire->avenue }} N°{{ $paiement->proprietaire->numeroPar }},Q/{{ $paiement->proprietaire->quartier }},C/{{ $paiement->proprietaire->commune }}</p>
                    <p><strong>Adresse de la parcelle :</strong> Av/{{ $paiement->parcelle->avenue }} N°{{ $paiement->parcelle->numeroPar }},Q/{{ $paiement->parcelle->quartier }},C/{{ $paiement->parcelle->commune }}</p>
                    <p><strong>Montant :</strong> {{ $paiement->montant }}</p>
                    <p><strong>Date de Paiement :</strong> {{ $paiement->datePaie }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function printContent() {
        var printWindow = window.open('', '_blank');
        printWindow.document.write(`{!! addslashes(view('pages.paiements.print', compact('paiement'))->render()) !!}`);
        printWindow.document.close();
        printWindow.print();

        // Gérer l'événement "onbeforeunload" dans la fenêtre d'impression
        printWindow.onbeforeunload = function() {
            // Fermer la fenêtre d'impression
            printWindow.close();
        };
    }
</script>
@endsection