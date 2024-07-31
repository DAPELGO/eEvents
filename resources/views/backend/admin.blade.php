@extends('backend.layouts.layouts')
@section('home', 'active')
@section('title', 'Tableau de bord')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Tableau de bord</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
            <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="fa fa-exclamation-triangle text-info"></i></h2>
                        <h3 class="">{{ $evenements }}</h3>
                        <h6 class="card-subtitle">Evènements</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="fa fa-slideshare text-success"></i></h2>
                        <h3 class="">0</h3>
                        <h6 class="card-subtitle">Formations</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="fa fa-users text-purple"></i></h2>
                        <h3 class="">0</h3>
                        <h6 class="card-subtitle">Abonnés</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="fa fa-file-text text-warning"></i></h2>
                        <h3 class="">0</h3>
                        <h6 class="card-subtitle">Articles</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
