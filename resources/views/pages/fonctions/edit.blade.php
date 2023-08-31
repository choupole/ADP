@extends('layouts.app')
@section('content')
<div class="min-height-200px">
   <div class="page-header">
      @if (session('error'))
      <div class="alert alert-danger">
          {{session('error')}}
      </div>
      @endif
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
                  <li class="breadcrumb-item active" aria-current="page">Edition fonction</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <h4 class="text-blue h4">Fonction</h4>
         <p class="mb-30"> {{$fonction->name}} </p>
      </div>
      <div class="wizard-content">
         <form id="myForm" class="tab-wizard wizard-circle wizard" action="{{ route('fonctions.modify' , $fonction->id) }}" method="POST">
            @csrf
            @method('POST')
            <!-- Step 2 -->
            <!-- Step 2 -->
            <h5>Police de la fonction</h5>
            <input type="hidden" name="role_id" value="{{$fonction->id}}" id="">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th class="col-1">#</th>
                     <th class="col-5 text-left">Entité</th>
                     <th>Créer</th>
                     <th>Lire</th>
                     <th>Modifier</th>
                     <th>Supprimer</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($models as $model)
                  <tr>
                     <td class="col-1 text-center"> {{++$i}} </td>
                     <td class="col-5 text-left">
                        {{ $model }}
                     </td>
                     @foreach ($actions as $action)
                     <td class="icheck-primary col-2  ">
                           <input type="checkbox" id=""
                           @php
                           $verify =  DB::select('select * from fonction_police where fonction_id = ? and model = ? and action = ? ', [$fonction->id, $model, $action] );
                           @endphp
                           @if ($verify)
                           checked
                           @else
                           @endif
                             name="form[{{$model.'_'.$action}}]"  class="justify-center" spellcheck="false">
                     </td>
                     @endforeach
                  </tr>
                  @endforeach
               </tbody>
            </table>
                <div>
                   <button type="submit" class="btn btn-default border float-right"><i class="icon-copy fa fa-floppy-o" aria-hidden="true"></i></button>
                </div>
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