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
                        <li class="breadcrumb-item active" aria-current="page">Création agent</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Création</h4>
            <p class="mb-30">Ajout d'un nouveau agent</p>
        </div>
        <div class="wizard-content">
            <form id="myForm" class="tab-wizard wizard-circle wizard" action="{{ route('agents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5>Information de l'agent</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Matricule :</label>
                                <input type="text" name="matricule" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Nom :</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Postnom :</label>
                                <input type="text" name="postnom" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Prenom :</label>
                                <input type="text" name="prenom" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Email :</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Mot de passe :</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                        </div>                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fonctions</label>
                                <select class="custom-select2 form-control" multiple="multiple" style="width: 100%;" name="fonctions[]">
                                    @foreach ($fonctions as $fonction)
                                        <option value="{{ $fonction->id }}">{{ $fonction->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image-input" onchange="updateFileLabel(this)">
                                    <label class="custom-file-label" for="image-input" id="file-label">Choisir un fichier</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" id="telephone-container">
                            <!-- Ajoutez cela à votre formulaire -->
                            <div class="form-group">
                                <label>Numéros de téléphone :</label>
                                <div id="phone-numbers-container">
                                    <div class="input-group">
                                        <input type="text" name="phone_numbers[]" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="addPhoneNumberField()">Ajouter</button>
                                        </div>
                                    </div>
                                </div>
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
                    L'agent est enregistré avec succés 
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
function addPhoneNumberField() {
    var container = document.getElementById('phone-numbers-container');

    var inputGroup = document.createElement('div');
    inputGroup.className = 'input-group';

    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'phone_numbers[]';
    input.className = 'form-control';

    var appendDiv = document.createElement('div');
    appendDiv.className = 'input-group-append';

    var removeButton = document.createElement('button');
    removeButton.className = 'btn btn-danger';
    removeButton.type = 'button';
    removeButton.textContent = 'Supprimer';
    removeButton.addEventListener('click', function() {
        container.removeChild(inputGroup);
    });

    appendDiv.appendChild(removeButton);
    inputGroup.appendChild(input);
    inputGroup.appendChild(appendDiv);

    container.appendChild(inputGroup);
}
    function updateFileLabel(input) {
        var fileLabel = document.getElementById('file-label');
        var fileName = input.files[0].name;
        fileLabel.textContent = fileName;
    }
</script>
<script>
    
    document.getElementById('submitFormLink').addEventListener('click', function() {
        document.getElementById('myForm').submit();
    });
</script>
<script src={{asset('AdminADP/vendors/scripts/process.js')}}></script>
<script src={{asset('AdminADP/src/plugins/jquery-steps/jquery.steps.js')}}></script>
<script src={{asset('AdminADP/vendors/scripts/steps-setting.js')}}></script>
@endsection