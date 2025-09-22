@extends('layouts.template')
@section('valeur', 'active')
@section('content')
<div class="mb-4 mt-1">
    <h4 style="padding: 0.4rem 0 0.4rem 1rem; background-color: #004ebc; color: white !important; font-size: 0.8rem;">LES VALEURS DES PARAMETRES</h4>
</div>
<div class="mt-4 shadow-lg p-4 ps-6 mb-4">
    <p class="text-700 fw-bold">Création d'une nouvelle valeur</p>
    <hr>
    <div class="row g-4">
        <div class="col-12 col-xl-10 order-1 order-xl-0">
            <form class="g-3 border p-4 rounded-2" action="{{ route('valeurs.store') }}" method="POST" novalidate="">
                @csrf
            <div class="row mb-3">
              <label class="col-sm-4 col-form-label col-form-label-sm" for="id_parent">Paramètre <span class="fas fa-asterisk fs--3 me-1 mb-1 text-danger"></span></label>
              <div class="col-sm-8">
                <select class="form-select" id="parametre_id" name="parametre_id" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                    <option value="">Selectionner un paramètre ...</option>
                    @foreach($parametres as $parametre)
                        <option value="{{ $parametre->id }}">{{ $parametre->libelle }}</option>
                    @endforeach
                  </select>
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label col-form-label-sm" for="id_parent">Valeur Parente</label>
                <div class="col-sm-8">
                  <select class="form-select" id="id_parent" name="id_parent" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                      <option value="">Selectionner une valeur parente</option>
                      @foreach($valeurs as $valeur)
                          <option value="{{ $valeur->id }}">{{ $valeur->libelle }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            <div class="row mb-3">
              <label class="col-sm-4 col-form-label col-form-label-sm" for="nom_valeur">Libellé <span class="fas fa-asterisk fs--3 me-1 mb-1 text-danger"></span></label>
              <div class="col-sm-8">
                <input class="form-control @error('nom_valeur') is-invalid @enderror" id="nom_valeur" name="nom_valeur" type="text" placeholder="Nom du valeur" value="{{ old('nom_valeur') }}" />
                @error('nom_valeur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <hr>
            <button class="btn btn-primary btn-sm" type="submit">Enregistrer</button>
            <a class="btn btn-outline-primary btn-sm" href="{{ route('valeurs.index') }}">Fermer</a>
          </form>
        </div>
    </div>
</div>
@endsection
