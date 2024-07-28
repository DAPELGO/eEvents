@extends('backend.layouts.layouts')
@section('event', 'active')
@section('title', 'Enregistrer un évènement')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Evènements</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
            <li class="breadcrumb-item">Evènements</li>
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
                    <h4 class="card-title">ENREGISTRER UN EVENEMENT</h4>
                    <hr>
                    <div class="row g-4">
                        <div class="col-12 col-xl-10 order-1 order-xl-0">
                            <form action="{{ route('events.store') }}" method="POST" class="g-3 border p-4 rounded-2" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="titre">Titre <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" placeholder="Titre de l'évènement..." value="{{ old('titre') }}" required>
                                        @error('titre')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="categorie">Catégorie <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <select class="custom-select @error('categorie') is-invalid @enderror" id="categorie" name="categorie" required>
                                            <option value="">Choisir une catégorie...</option>
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                                            @endforeach
                                        </select>
                                        @error('categorie')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="localite">Localité <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <select class="custom-select @error('localite') is-invalid @enderror" id="localite" name="localite" required>
                                            <option value="">Choisir une localité...</option>
                                            @foreach($localites as $localite)
                                                <option value="{{ $localite->id }}">{{ $localite->libelle }}</option>
                                            @endforeach
                                        </select>
                                        @error('localite')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="structure">Structure <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <select class="custom-select @error('structure') is-invalid @enderror" id="structure" name="structure" required>
                                            <option value="">Choisir une structure...</option>
                                            @foreach($structures as $structure)
                                                <option value="{{ $structure->id }}">{{ $structure->nom_structure }}</option>
                                            @endforeach
                                        </select>
                                        @error('structure')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="date_event">Date de l'évènement <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control @error('date_event') is-invalid @enderror" id="date_event" name="date_event" value="{{ old('date_event') }}" required>
                                        @error('date_event')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Image evenement --}}
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Image</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="description">Description <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Description de l'évènement..." required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row m-b-0">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        <a href="{{ route('events.index') }}" class="btn btn-secondary">Annuler</a>
                                    </div>
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
