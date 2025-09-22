@extends('backend.layouts.layouts')
@section('structure', 'active')
@section('title', 'Modifier une structure')
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
            <li class="breadcrumb-item active">Modifier</li>
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
                    <h4 class="card-title">MODIFIER UNE STRUCTURE</h4>
                    <hr>
                    <div class="row g-4">
                        <div class="col-12 col-xl-10 order-1 order-xl-0">
                            <form class="g-3 border p-4 rounded-2" action="{{ route('structures.update', $structure->id) }}" method="POST" novalidate="">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="id_valeur_niveaustructure">Niveau Structure <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <select class="custom-select @error('id_valeur_niveaustructure') is-invalid @enderror select2" id="id_valeur_niveaustructure" name="id_valeur_niveaustructure" onchange="changeValue('id_valeur_niveaustructure', 'id_valeur_typestructure', 'type_structure');" required>
                                            <option value="0" selected disabled>Selectionner un niveau de structure...</option>
                                            @foreach($valeurs_niveau_structures as $valeur_niveau_structures)
                                                <option value="{{ $valeur_niveau_structures->id }}" @if($valeur_niveau_structures->id == $structure->id_niveau_structure) selected @endif>{{ $valeur_niveau_structures->libelle }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_valeur_niveaustructure')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @if ($structure->id_type_structure != null || $structure->niveau_structure->libelle == env('FS'))
                                    <div class="row mb-3" id="type_structure_display">
                                        <label class="col-sm-4 col-form-label" for="id_valeur_typestructure">Type Structure  <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                        <div class="col-sm-8">
                                        <select class="custom-select @error('id_valeur_typestructure') is-invalid @enderror select2" id="id_valeur_typestructure" name="id_valeur_typestructure" required>
                                                <option value="">Selectionner un type de structure ...</option>
                                                @foreach($valeurs_type_structures as $valeur_type_structures)
                                                    <option value="{{ $valeur_type_structures->id }}" @if($valeur_type_structures->id == $structure->id_type_structure) selected @endif>{{ $valeur_type_structures->libelle }}</option>
                                                @endforeach
                                        </select>
                                        @error('id_valeur_typestructure')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                @else
                                    <div class="row mb-3" id="type_structure_display" style="display: none;">
                                        <label class="col-sm-4 col-form-label" for="id_valeur_typestructure">Type Structure  <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                        <div class="col-sm-8">
                                        <select class="custom-select @error('id_valeur_typestructure') is-invalid @enderror select2" id="id_valeur_typestructure" name="id_valeur_typestructure" required>
                                                <option value="">Selectionner un type de structure ...</option>
                                                @foreach($valeurs_type_structures as $valeur_type_structures)
                                                    <option value="{{ $valeur_type_structures->id }}">{{ $valeur_type_structures->libelle }}</option>
                                                @endforeach
                                        </select>
                                        @error('id_valeur_typestructure')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="parent_id">Structure Parente</label>
                                    <div class="col-sm-8">
                                    <select class="custom-select @error('parent_id') is-invalid @enderror select2" id="parent_id" name="parent_id">
                                        <option value="">Selectionner une structure...</option>
                                        @foreach ($valeurs_structures_non_fs as $niveau_structures_non_fs => $valeurs_structures_non_fs)
                                            <optgroup label="{{ mb_strtoupper($niveau_structures_non_fs) }}">
                                                @foreach ($valeurs_structures_non_fs as $valeur_structures_non_fs)
                                                        <option value="{{ $valeur_structures_non_fs->id }}" @if($valeur_structures_non_fs->id == $structure->parent_id) selected @endif>{{ mb_strtoupper($valeur_structures_non_fs->niveau_structure->libelle).' - '.$valeur_structures_non_fs->nom_structure }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="name">Nom de la structure <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                    <input class="form-control @error('nom_structure') is-invalid @enderror" id="nom_structure" name="nom_structure" type="text" placeholder="Nom de la structure..." value="{{ old('nom_structure') ? old('nom_structure') : $structure->nom_structure }}" />
                                    @error('nom_structure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="name">UUID <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                    <input class="form-control @error('code_structure') is-invalid @enderror" id="code_structure" name="code_structure" type="text" placeholder="Code UUID..." value="{{ old('code_structure') ? old('code_structure') : $structure->code_structure }}" />
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
                                            <input type="checkbox" id="private_structure" name="private_structure" value="1"
                                            @if(old('private_structure') == 1)
                                                checked
                                            @elseif($structure->is_public_structure == false)
                                                checked
                                            @endif/>
                                            <span class="lever switch-col-grey"></span>
                                        </label>
                                    </div>
                                    @error('private_structure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>
                                <button class="btn btn-primary mr-2" type="submit">Modifier</button>
                                <a class="btn btn-secondary" href="{{ route('structures.index') }}">Fermer</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
