@extends('layouts.app')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Agent Details</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('agents.index') }}">Agents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agent Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Agent Details</h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Matricule:</label>
                    <input type="text" class="form-control" value="{{ $agent->matricule }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nom:</label>
                    <input type="text" class="form-control" value="{{ $agent->name }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Postnom:</label>
                    <input type="text" class="form-control" value="{{ $agent->postnom }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Prenom:</label>
                    <input type="text" class="form-control" value="{{ $agent->prenom }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" value="{{ $agent->email }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fonctions:</label>
                    <ul>
                        @foreach ($agent->fonctions as $fonction)
                            <li>{{ $fonction->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Image:</label>
                    <img width="100px" height="100px" src="{{asset('assets/uploads/agents/'.$agent->image )}}" alt="Agent Image">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone Numbers:</label>
                    <ul>
                        @foreach ($agent->phoneNumbers as $phoneNumber)
                            <li>{{ $phoneNumber->phone_number }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection