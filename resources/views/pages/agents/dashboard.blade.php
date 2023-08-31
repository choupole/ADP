@extends('layouts.app')
@section('content')
<div class="card-box pd-20 height-100-p mb-30">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src=" {{asset('AdminADP/vendors/images/banner-img.png')}}" alt="">
        </div>
        <div class="col-md-8">
            <h4 class="font-20 weight-500 mb-10 text-capitalize">
                Content de te revoir <div class="weight-600 font-30 text-blue"> {{Auth::user()?->name}} </div>
            </h4>
            <p class="font-18 max-width-600">L'application "GestADP" simplifie la génération et l'impression d'attestations de droit de proprietés immombilières
                , offrant un outil professionnel pour les propriétairs et les professionnels de l'immobilier.
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center">
                <div class="progress-data">
                    <div id="chart"></div>
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0">{{ $attestationsCount }}</div>
                    <div class="weight-600 font-14">Attestations</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center">
                <div class="progress-data">
                    <div id="chart2"></div>
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0">{{ $paiementsCount }}</div>
                    <div class="weight-600 font-14">Factures</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center">
                <div class="progress-data">
                    <div id="chart3"></div>
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0">{{ $proprietairesCount }}</div>
                    <div class="weight-600 font-14">Proprietaires</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center">
                <div class="progress-data">
                    <div id="chart4"></div>
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0">{{ $parcellesCount }}</div>
                    <div class="weight-600 font-14">Parcelle</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection