@extends('layouts.app')
@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    {{-- 
                    <h4>Form Wizards</h4>
                    --}}
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edition parcelle</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Edition</h4>
            <p class="mb-30">Edition d'une parcelle</p>
        </div>
        <div class="wizard-content">
            <form id="myForm" class="tab-wizard wizard-circle wizard" action="{{ route('parcelles.update', $parcelle->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Step 2 -->
                <!-- Step 2 -->
                <h5>Information du Proprietaire</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Proprietaire</label>
                                <select class="custom-select2 form-control" style="width: 100%;" name="proprietaire_id" onchange="fillOwnerInfo(this)">
                                    @foreach ($proprietaires as $proprietaire)
                                    <option value="">{{ $proprietaire->nom }} {{ $proprietaire->postnom }} {{ $proprietaire->prenom }}</option>
                                    <option value="{{ $proprietaire->id }}" data-sexe="{{ $proprietaire->sexe }}" data-adresse="Av/{{$proprietaire->avenue }}, n°{{$proprietaire->numeroPar }},Q/{{$proprietaire->quartier }},C/{{$proprietaire->commune }}">
                                        {{ $proprietaire->nom }} {{ $proprietaire->postnom }} {{ $proprietaire->prenom }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sexe :</label>
                                <input type="text" name="sexe" class="form-control proprietaire-sexe" value="{{ $proprietaire->sexe }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Adresse :</label>
                                <textarea class="form-control proprietaire-adresse" value="" readonly>Av/{{$proprietaire->avenue }}, n°{{$proprietaire->numeroPar }},Q/{{$proprietaire->quartier }},C/{{$proprietaire->commune }}</textarea>
                            </div>
                        </div>
                        <input type="hidden" name="proprietaire_id" id="proprietaire_id" value="">
                    </div>
                </section>
                <!-- Step 4 -->
                <h5>Adresse</h5>
                <section>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Catégorie</label>
                                <select class="custom-select2 form-control" style="width: 100%;" name="categorie_id" onchange="fillCategoryId(this)">
                                    @foreach ($categories as $category)
                                    <option value="">{{ $category->name }}</option>
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Numéro ACP :</label>
                                <input type="text" name="numACP" value="{{ $parcelle->numACP }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date de la création de l'ACP :</label>
                                <input type="date" name="dateED" value="{{ $parcelle->dateED }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Numéro Parcelle :</label>
                                <input type="number" name="numeroPar" value="{{ $parcelle->numeroPar }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Avenue :</label>
                                <input type="text" name="avenue" value="{{ $parcelle->avenue }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quartier :</label>
                                <input type="text" name="quartier" value="{{ $parcelle->quartier }}"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Commune :</label>
                                <input type="text" name="commune" value="{{ $parcelle->commune }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </section>
                <input type="hidden" name="category_id" id="category_id" value="">
            </form>
        </div>
    </div>
    <!-- success Popup html Start -->
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Formulaire Soumis!</h3>
                    <div class="mb-30 text-center"><img src="{{asset ('AdminADP/vendors/images/success.png')}}"></div>
                    La parcelle est mis à jour avec succés 
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="javascript:void(0)" class="btn btn-primary submit-form-button" data-dismiss="modal">OK</a>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html End -->
</div>
@endsection
@section('scripts')
<script>
    document.querySelector('.submit-form-button').addEventListener('click', function() {
    document.getElementById('myForm').submit();
    });
</script>
<script>
    function fillCategoryId(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var categorieIdInput = document.getElementById('category_id');
    
    categorieIdInput.value = selectedOption.value;
    }
    function fillOwnerInfo(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var sexeInput = document.querySelector('.proprietaire-sexe');
    var adresseTextarea = document.querySelector('.proprietaire-adresse');
    var proprietaireIdInput = document.getElementById('proprietaire_id');
    
    sexeInput.value = selectedOption.getAttribute('data-sexe');
    adresseTextarea.value = selectedOption.getAttribute('data-adresse');
    proprietaireIdInput.value = selectedOption.value;
    }
</script>
<script src={{asset('AdminADP/vendors/scripts/process.js')}}></script>
<script src={{asset('AdminADP/src/plugins/jquery-steps/jquery.steps.js')}}></script>
<script src={{asset('AdminADP/vendors/scripts/steps-setting.js')}}></script>
@endsection