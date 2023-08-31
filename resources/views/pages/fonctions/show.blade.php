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
                        <li class="breadcrumb-item active" aria-current="page"> {{$fonction->name}} </li>
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
                                <a class="nav-link active text-blue" data-toggle="tab" href="#home" role="tab" aria-selected="true">Fonction</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Agents</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="col-1 text-left">id</th>
                                                <th class="text-left col-4">Entité</th>
                                                <th>Créer</th>
                                                <th>Lire</th>
                                                <th>Modifier</th>
                                                <th>Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($models as $model)
                                            <tr>
                                                <td> {{++$i}} </td>
                                                <td class="text-left col-4">
                                                    {{ $model }}
                                                </td>
                                                @foreach ($actions as $action)
                                                <td class="text-center">
                                                    @php
                                                    $verify =  DB::select('select * from fonction_police where fonction_id = ? and model = ? and action = ? ', [$fonction->id, $model, $action] );
                                                    @endphp
                                                    @if ($verify)
                                                    <i class="icon-copy fa fa-check-square-o" aria-hidden="true"></i>
                                                    @else
                                                    <i class="icon-copy fa fa-close" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-right">
                                        <a class="btn btn-outline-default border"  href="{{ route('fonctions.edit', $fonction->id) }}"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel">
                                <div class="pd-20">
                                    <table id="example1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($agents as $agent)
                                            <tr>
                                                <td> <a href="{{route('agents.show', $agent->id)}}">{{$agent->name }}</a></td>
                                                <td> {{$agent->email }} </td>
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