@extends('layouts.app')
@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-6 col-sm-12">
            <div class="title">
               <h4>DataTable</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">DataTable</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Création</h4>
            <p class="mb-30">Ajout d'une nouvelle attestation</p>
        </div>
            <div class="wizard-content">
                <form id="myForm" class="tab-wizard wizard-circle wizard" action="{{ route('attestations.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <!-- Step 2 -->
                    <!-- Step 2 -->
                    <h5>Information de l'attestation</h5>
                        <section>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Numéro du paiement : </label>
                                    <select class="custom-select2 form-control" style="width: 100%;" name="" onchange="fillOwnerInfoonePaiement(this)">
                                    <option value="">Selectionner numéro de paiement</option>
                                    @foreach ($allPaiement as $onePaiement)                                    
                                    <option value="{{ $onePaiement->id }}" data-onPaiementId="{{$onePaiement->id}}"  data-datePaie="{{$onePaiement->datePaie}}"  data-parcelleId="{{$onePaiement->parcelle->id}}" data-parcelleInfo="N°{{$onePaiement->parcelle->numeroPar}}, Av/{{$onePaiement->parcelle->avenue}} Q/{{$onePaiement->parcelle->quartier}} C/{{$onePaiement->parcelle->commune}}" data-userId={{$onePaiement->user->id}}  data-proprietaireId="{{ $onePaiement->proprietaire->id }}" data-proprietaireInfo ="{{ $onePaiement->proprietaire->nom}} {{ $onePaiement->proprietaire->postnom }} {{ $onePaiement->proprietaire->prenom }}"  >
                                        {{ $onePaiement->id }}
                                    </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                <label >Proprietaire :</label>
                                <input type="text" class="form-control proprietaireInfo" readonly>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Adresse parcelle :</label>
                                    <input class="form-control parcelleInfo" readonly>
                                    </div>
                                </div>
                                {{-- les inputs cachées --}}
                                <input type="hidden" name="proprietaire_id" class="proprietaire_id" id="proprietaire_id" value="">
                                <input type="hidden" name="user_id" class="user_id" id="user_id" value="">
                                <input type="hidden" name="parcelle_id" class="parcelle_id" id="parcelle_id" value="">
                                <input type="hidden" name="paiement_id" class="onePaiement_id" id="onePaiement_id" value="">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date de l'edition :</label>
                                        <input type="date" name="dateED" id="dateField" class="form-control datePaie" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date de remise :</label>
                                        <input type="date" name="dateREM" id="dateFieldRem" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </section>      
                </form>
            </div>
   </div>
</div>
<!-- success Popup html Start -->
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body text-center font-18">
            <h3 class="mb-20">Formulaire Soumis!</h3>
            <div class="mb-30 text-center"><img src="{{asset ('AdminADP/vendors/images/success.png')}}"></div>
            La parcelle est enregistré avec succés 
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
    document.addEventListener('DOMContentLoaded', function() {
        var dateFieldRem = document.getElementById('dateFieldRem');
        var currentDate = new Date().toISOString().split('T')[0];
        dateFieldRem.value = currentDate;
    });
 </script>
<script>
   document.querySelector('.submit-form-button').addEventListener('click', function() {
   document.getElementById('myForm').submit();
   });
</script>
<script>
function fillOwnerInfoonePaiement(selectElement) {
   var selectedOption = selectElement.options[selectElement.selectedIndex];
   var proprietaireInput = document.querySelector('.proprietaireInfo');
   var adresseInput = document.querySelector('.parcelleInfo');
   var dataInput = document.querySelector('.datePaie');
   var proprietaireIdInput = document.querySelector('.proprietaire_id'); 
   var parcelleInput = document.querySelector('.parcelle_id');
   var onePaiementIdInput = document.querySelector('.onePaiement_id');
   var userIdInput = document.querySelector('.user_id');

   proprietaireInput.value = selectedOption.getAttribute('data-proprietaireInfo');
   adresseInput.value = selectedOption.getAttribute('data-parcelleInfo');
   dataInput.value = selectedOption.getAttribute('data-datePaie');
   proprietaireIdInput.value = selectedOption.getAttribute('data-proprietaireId');
   parcelleInput.value = selectedOption.getAttribute('data-parcelleId');
   onePaiementIdInput.value = selectedOption.getAttribute('data-onPaiementId');
   userIdInput.value = selectedOption.getAttribute('data-userId');
}
</script>
<script src={{asset('AdminADP/vendors/scripts/process.js')}}></script>
<script src={{asset('AdminADP/src/plugins/jquery-steps/jquery.steps.js')}}></script>
<script src={{asset('AdminADP/vendors/scripts/steps-setting.js')}}></script>
@endsection