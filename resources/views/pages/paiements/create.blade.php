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
                  <li class="breadcrumb-item active" aria-current="page">Création parcelle</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <h4 class="text-blue h4">Création</h4>
         <p class="mb-30">Ajout d'une nouveau paiement</p>
      </div>
      <div class="wizard-content">
         <form id="myForm" class="tab-wizard wizard-circle wizard" action="{{ route('paiements.store') }}" method="POST">
            @csrf
            @method('POST')
            <!-- Step 2 -->
            <!-- Step 2 -->
            <h5>Information du Proprietaire</h5>
            <section>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Code ACP : </label>
                        <select class="custom-select2 form-control" style="width: 100%;" name="" onchange="fillOwnerInfoAcp(this)">
                           <option value="">Selectionner un ACP</option>
                           @foreach ($parcelles as $parcelle)
                           <option value="{{ $parcelle->id }}" data-parcelleId="{{$parcelle->id}}" data-proprietaireId="{{ $parcelle->proprietaire->id }}" data-proprietaire="{{ $parcelle->proprietaire->nom }} {{ $parcelle->proprietaire->postnom }} {{ $parcelle->proprietaire->prenom }}" data-adresse="Av/{{$parcelle->avenue }}, n°{{$parcelle->numeroPar }},Q/{{$parcelle->quartier }},C/{{$parcelle->commune }}">
                              {{ $parcelle->numACP }}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="form-group">
                        <label >Proprietaire :</label>
                        <input type="text" class="form-control proprietaire-info" readonly>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Adresse parcelle :</label>
                        <input class="form-control proprietaire-adresse" readonly>
                     </div>
                  </div>
                  <input type="hidden" name="proprietaire_id" class="proprietaire_id" id="proprietaire_id" value="">
                  <input type="hidden" name="parcelle_id" class="parcelle_id" id="parcelle_id" value="">
                  <input type="hidden" name="user_id" value="{{ Auth::id() }}">
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label >Montant :</label>
                        <input type="number" name="montant" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Date :</label>
                        <input type="date" name="datePaie" id="dateField" class="form-control">
                     </div>
                  </div>
               </div>
            </section>
            <!-- Step 4 -->
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
               Le paiement est enregistré avec succés 
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
       var dateField = document.getElementById('dateField');
       var currentDate = new Date().toISOString().split('T')[0];
       dateField.value = currentDate;
   });
</script>
<script>
   document.querySelector('.submit-form-button').addEventListener('click', function() {
   document.getElementById('myForm').submit();
   });
</script>
<script>
   function fillOwnerInfoAcp(selectElement) {
      var selectedOption = selectElement.options[selectElement.selectedIndex];
      var proprietaireInput = document.querySelector('.proprietaire-info');
      var adresseInput = document.querySelector('.proprietaire-adresse');
      var proprietaireIdInput = document.querySelector('.proprietaire_id');
      var parcelleInput = document.querySelector('.parcelle_id');
   
      proprietaireInput.value = selectedOption.getAttribute('data-proprietaire');
      adresseInput.value = selectedOption.getAttribute('data-adresse');
      proprietaireIdInput.value = selectedOption.getAttribute('data-proprietaireId');
      parcelleInput.value = selectedOption.getAttribute('data-parcelleId');

   }
</script>
<script src={{asset('AdminADP/vendors/scripts/process.js')}}></script>
<script src={{asset('AdminADP/src/plugins/jquery-steps/jquery.steps.js')}}></script>
<script src={{asset('AdminADP/vendors/scripts/steps-setting.js')}}></script>
@endsection