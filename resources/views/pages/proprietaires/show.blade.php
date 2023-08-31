@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Visualisation du propriétaire</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('proprietaires.index') }}">Liste des propriétaires</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Visualisation</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Détails du propriétaire</h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nom :</label>
                    <input type="text" class="form-control" value="{{ $proprietaire->nom }}" readonly>
                </div>
                <div class="form-group">
                    <label>Postnom :</label>
                    <input type="text" class="form-control" value="{{ $proprietaire->postnom }}" readonly>
                </div>
                <div class="form-group">
                    <label>Prénom :</label>
                    <input type="text" class="form-control" value="{{ $proprietaire->prenom }}" readonly>
                </div>
                <div class="form-group">
                    <label>Sexe :</label>
                    <input type="text" class="form-control" value="{{ $proprietaire->sexe }}" readonly>
                </div>
                <div class="form-group">
                    <label>Nationalité :</label>
                    @foreach ($proprietaire->nationalities as $nationality)
                        <input type="text" class="form-control" value="{{ $nationality->name }}" readonly>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Numéro Parcelle :</label>
                    <input type="text" class="form-control" value="{{ $proprietaire->numeroPar }}" readonly>
                </div>
                <div class="form-group">
                    <label>Avenue :</label>
                    <input type="text" class="form-control" value="{{ $proprietaire->avenue }}" readonly>
                </div>
                <div class="form-group">
                    <label>Quartier :</label>
                    <input type="text" class="form-control" value="{{ $proprietaire->quartier }}" readonly>
                </div>
                <div class="form-group">
                    <label>Commune :</label>
                    <input type="text" class="form-control" value="{{ $proprietaire->commune }}" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <a href="{{ route('proprietaires.edit', $proprietaire->id) }}" class="btn btn-primary">Modifier</a>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection