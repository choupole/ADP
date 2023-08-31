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
                        <li class="breadcrumb-item active" aria-current="page"> {{$nationality->name}} </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

        <div class="pd-20 card-box mb-30 clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                    <h5 class="h4 text-blue mb-20">Default Tab</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-blue" data-toggle="tab" href="#home" role="tab" aria-selected="true">Nationalité</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Proprietaires</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                                <div class="pd-20">
                                    <p> {{$nationality->name}} </p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel">
                                <div class="pd-20">
                                    <table id="example1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Postnom</th>
                                            <th>Prenom</th>
                                            <th>Adressse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proprietaires as $proprietaire)
                                        <tr>
                                            <td> <a href="{{route('proprietaires.show', $proprietaire->id)}}">{{$proprietaire->nom }}</a></td>
                                            <td> {{$proprietaire->postnom }} </td>
                                            <td> {{$proprietaire->prenom }} </td>
                                            <td> {{$proprietaire->avenenue }} {{$proprietaire->quartier }} {{$proprietaire->commune }} </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

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