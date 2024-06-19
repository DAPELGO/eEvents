@extends('layouts.template')
@section('structure', 'active')
@section('content')
<div class="mb-4 mt-1">
    <h4 style="padding: 0.4rem 0 0.4rem 1rem; background-color: #004ebc; color: white !important; font-size: 0.8rem;">STRUCTURES</h4>
</div>
<div class="mt-4 shadow-lg p-4 ps-6 mb-4">
    <p class="text-700 fw-bold">Création d'une nouvelle structure</p>
    <hr>
    <div class="mt-4">
        <div class="row g-4">
            <div class="col-12 col-xl-10 order-1 order-xl-0">
                <form class="g-3 border p-4 rounded-2" action="{{ route('structures.store') }}" method="POST" novalidate="">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label col-form-label-sm" for="id_valeur_niveaustructure">Niveau Structure <span class="fas fa-asterisk fs--3 me-1 mb-1 text-danger"></span></label>
                        <div class="col-sm-8">
                            <select class="form-select" id="id_valeur_niveaustructure" name="id_valeur_niveaustructure" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}' onchange="changeValue('id_valeur_niveaustructure', 'id_valeur_typestructure', 'type_structure');" required>
                                <option value="0" selected disabled>Selectionner un niveau de structure...</option>
                                @foreach($valeurs_niveau_structures as $valeur_niveau_structures)
                                    <option value="{{ $valeur_niveau_structures->id }}">{{ $valeur_niveau_structures->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3" id="type_structure_display" style="display: none;">
                      <label class="col-sm-4 col-form-label col-form-label-sm" for="id_valeur_typestructure">Type Structure <span class="fas fa-asterisk fs--3 me-1 mb-1 text-danger"></span></label>
                      <div class="col-sm-8">
                        <select class="form-select" id="id_valeur_typestructure" name="id_valeur_typestructure" required>
                            <option value="">Selectionner un type de structure ...</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-4 col-form-label col-form-label-sm" for="parent_id">Structure Parente</label>
                      <div class="col-sm-8">
                        <select class="form-select" id="parent_id" name="parent_id" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                            <option value="">Selectionner une structure...</option>
                            @foreach ($valeurs_structures_non_fs as $niveau_structures_non_fs => $valeurs_structures_non_fs)
                                <optgroup label="{{ strtoupper($niveau_structures_non_fs) }}">
                                    @foreach ($valeurs_structures_non_fs as $valeur_structures_non_fs)
                                        <option value="{{ $valeur_structures_non_fs->id }}">{{ strtoupper($valeur_structures_non_fs->niveau_structure->libelle).' - '.$valeur_structures_non_fs->nom_structure }}</option> 
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-4 col-form-label col-form-label-sm" for="nom_structure">Nom de la structure <span class="fas fa-asterisk fs--3 me-1 mb-1 text-danger"></span></label>
                      <div class="col-sm-8">
                        <input class="form-control @error('nom_structure') is-invalid @enderror" id="nom_structure" name="nom_structure" type="text" placeholder="Nom de structure" value="{{ old('nom_structure') }}" required />
                        @error('nom_structure')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label col-form-label-sm" for="code_structure">Code MFL</label>
                        <div class="col-sm-8">
                          <input class="form-control @error('code_structure') is-invalid @enderror" id="code_structure" name="code_structure" type="text" placeholder="Code MFL..." value="{{ old('code_structure') }}" />
                          @error('code_structure')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label col-form-label-sm" for="private_structure">Structure privée </label>
                        <div class="col-sm-8">
                            <div class="form-check form-switch">
                                <input class="form-check-input" id="private_structure" name="private_structure" type="checkbox" value="1" @if(old('private_structure') == 1) checked @endif/>
                            </div>
                            @error('private_structure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-primary btn-sm" type="submit">Enregistrer</button>
                    <a href="{{ route('structures.index') }}" class="btn btn-outline-primary btn-sm">Fermer</a>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection
