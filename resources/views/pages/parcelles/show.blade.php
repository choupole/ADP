@extends('layouts.app')
@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    {{-- <h4>Form Wizards</h4> --}}
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Détails de la parcelle</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Détails de la parcelle</h4>
        </div>
        <div class="wizard-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Propriétaire :</label>
                        <input type="text" class="form-control" value="{{ $parcelle->proprietaire->nom }} {{ $parcelle->proprietaire->postnom }} {{ $parcelle->proprietaire->prenom }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Sexe :</label>
                        <input type="text" class="form-control" value="{{ $parcelle->proprietaire->sexe }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Adresse :</label>
                        <textarea class="form-control" readonly>Av/{{ $parcelle->avenue }} N°{{ $parcelle->numeroPar }},Q/{{ $parcelle->quartier }},C/{{ $parcelle->commune }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Catégorie :</label>
                        <input type="text" class="form-control" value="{{ $parcelle->category->name }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Numéro ACP :</label>
                        <input type="text" class="form-control" value="{{ $parcelle->numACP }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date de création de l'ACP :</label>
                        <input type="text" class="form-control" value="{{ $parcelle->dateED }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Numéro de parcelle :</label>
                        <input type="text" class="form-control" value="N°{{ $parcelle->numeroPar }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-right">
                        <a href="{{ route('parcelles.edit', $parcelle->id) }}" class="btn btn-primary">Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection