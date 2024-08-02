@extends('backend.layouts.layouts')
@section('structure', 'active')
@section('title', 'Enregistrer une structure')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Structures</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
            <li class="breadcrumb-item">Structures</li>
            <li class="breadcrumb-item active">Enregistrer</li>
        </ol>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- <div class="card-group"> -->
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-body collapse show">
                    <h4 class="card-title">ENREGISTRER UNE STRUCTURE</h4>
                    <hr>
                    <div class="row g-4">
                        <div class="col-12 col-xl-10 order-1 order-xl-0">
                            <form action="{{ route('structures.store') }}" method="POST" class="g-3 border p-4 rounded-2">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="id_valeur_niveaustructure">Niveau Structure <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <select class="custom-select @error('id_valeur_niveaustructure') is-invalid @enderror" id="id_valeur_niveaustructure" name="id_valeur_niveaustructure" onchange="changeValue('id_valeur_niveaustructure', 'id_valeur_typestructure', 'type_structure');" required>
                                            <option value="0" selected disabled>Selectionner un niveau de structure...</option>
                                            @foreach($valeurs_niveau_structures as $valeur_niveau_structures)
                                                <option value="{{ $valeur_niveau_structures->id }}">{{ $valeur_niveau_structures->libelle }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_valeur_niveaustructure')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3" id="type_structure_display" style="display: none;">
                                  <label class="col-sm-4 col-form-label" for="id_valeur_typestructure">Type Structure <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                  <div class="col-sm-8">
                                    <select class="custom-select @error('id_valeur_typestructure') is-invalid @enderror" id="id_valeur_typestructure" name="id_valeur_typestructure" required>
                                        <option value="">Selectionner un type de structure ...</option>
                                    </select>
                                    @error('id_valeur_typestructure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-4 col-form-label" for="parent_id">Structure Parente</label>
                                  <div class="col-sm-8">
                                    <select class="custom-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id" data-choices="data-choices">
                                        <option value="">Selectionner une structure...</option>
                                        @foreach ($valeurs_structures_non_fs as $niveau_structures_non_fs => $valeurs_structures_non_fs)
                                            <optgroup label="{{ strtoupper($niveau_structures_non_fs) }}">
                                                @foreach ($valeurs_structures_non_fs as $valeur_structures_non_fs)
                                                    <option value="{{ $valeur_structures_non_fs->id }}">{{ strtoupper($valeur_structures_non_fs->niveau_structure->libelle).' - '.$valeur_structures_non_fs->nom_structure }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-4 col-form-label" for="nom_structure">Nom de la structure <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                  <div class="col-sm-8">
                                    <input class="form-control @error('nom_structure') is-invalid @enderror" id="nom_structure" name="nom_structure" type="text" placeholder="Nom de structure" value="{{ old('nom_structure') }}" required />
                                    @error('nom_structure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="code_structure">UUID</label>
                                    <div class="col-sm-8">
                                      <input class="form-control @error('code_structure') is-invalid @enderror" id="code_structure" name="code_structure" type="text" placeholder="UIID..." value="{{ old('code_structure') }}" />
                                      @error('code_structure')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">

                                    <div class="switch">
                                        <label class="col-form-label" for="private_structure">
                                            Structure privée
                                            <input type="checkbox" id="private_structure" name="private_structure" value="1" @if(old('private_structure') == 1) checked @endif>
                                            <span class="lever switch-col-grey"></span>
                                        </label>
                                    </div>
                                    @error('private_structure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row">
                                    <button class="btn btn-primary mr-2" type="submit">Enregistrer</button>
                                    <a href="{{ route('structures.index') }}" class="btn btn-secondary">Fermer</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
