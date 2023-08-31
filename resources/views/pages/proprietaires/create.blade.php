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
                        <li class="breadcrumb-item active" aria-current="page">Création proprietaire</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Création</h4>
            <p class="mb-30">Ajout d'un nouveau proprietaire</p>
        </div>
        <div class="wizard-content">
            <form id="myForm" class="tab-wizard wizard-circle wizard" action="{{ route('proprietaires.store') }}" method="POST">
                @csrf
                <h5>Information personnel</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Nom :</label>
                                <input type="text" name="nom" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Postnom :</label>
                                <input type="text" name="postnom" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Prénom :</label>
                                <input type="text" name="prenom" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sexe :</label>
                                <select class="custom-select form-control" name="sexe">
                                    <option value="">Genre</option>
                                    <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>M</option>
                                    <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>F</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nationalité</label>
                                <select class="custom-select2 form-control" multiple="multiple" style="width: 100%;" name="nationalities[]">
                                    @foreach ($nationalities as $nationality)
                                        <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 4 -->
                <h5>Adresse</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Numéro Parcelle :</label>
                                <input type="number" name="numeroPar" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Avenue :</label>
                                <input type="text" name="avenue" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quartier :</label>
                                <input type="text" name="quartier"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Commune :</label>
                                <input type="text" name="commune" class="form-control">
                            </div>
                        </div>
                    </div>
                </section>
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
                    Le proprietaire est enregistré avec succés 
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="javascript:void(0)" id="submitFormLink" class="btn btn-primary" data-dismiss="modal">OK</a>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html End -->
</div>
@endsection

@section('scripts')
<script>
    
    document.getElementById('submitFormLink').addEventListener('click', function() {
        document.getElementById('myForm').submit();
    });
</script>
<script src={{asset('AdminADP/vendors/scripts/process.js')}}></script>
<script src={{asset('AdminADP/src/plugins/jquery-steps/jquery.steps.js')}}></script>
<script src={{asset('AdminADP/vendors/scripts/steps-setting.js')}}></script>
@endsection