@extends('layouts.template')
@section('page_title', 'ECOM | Add Category')
@section('parametre', 'active')
@section('content')
<div class="mb-4 mt-1">
    <h4 style="padding: 0.4rem 0 0.4rem 1rem; background-color: #004ebc; color: white !important; font-size: 0.8rem;">DONNÉES DE PARAMÈTRE</h4>
</div>
<div class="mt-4 shadow-lg p-4 ps-6 mb-4">
    <p class="text-700 fw-bold">Création d'une nouvelle valeur</p>
    <hr>
    <div class="row g-4">
        <div class="col-12 col-xl-10 order-1 order-xl-0">
            <form class="g-3 border p-4 rounded-2" action="{{ route('parametres.store') }}" method="POST" novalidate="">
                @csrf
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label col-form-label-sm" for="parent_id">Parent</label>
                <div class="col-sm-8">
                <select class="form-select" id="parent_id" name="parent_id" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                    <option value="">Selectionner un paramètre ...</option>
                    @foreach($parametres as $parametre)
                        <option value="{{ $parametre->id }}">{{ $parametre->libelle }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label col-form-label-sm" for="nom_parametre">Libellé <span class="fas fa-asterisk fs--3 me-1 mb-1 text-danger"></span></label>
                <div class="col-sm-8">
                <input class="form-control form-control-sm @error('nom_parametre') is-invalid @enderror" id="nom_parametre" name="nom_parametre" type="text" placeholder="Nom du paramètre..." value="{{ old('nom_parametre') }}" />
                @error('nom_parametre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <hr>
            <button class="btn btn-primary btn-sm" type="submit">Enregistrer</button>
            <a class="btn btn-outline-primary btn-sm" href="{{ route('parametres.index') }}">Fermer</a>
            </form>
        </div>
    </div>

</div>
@endsection
