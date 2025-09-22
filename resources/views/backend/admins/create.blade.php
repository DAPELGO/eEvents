@extends('backend.layouts.layouts')
@section('categorie', 'active')
@section('title', 'Enregistrer une catégorie')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Catégories</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
            <li class="breadcrumb-item">Catégories</li>
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
                    <h4 class="card-title">ENREGISTRER UNE CATEGORIE</h4>
                    <hr>
                    <div class="row g-4">
                        <div class="col-12 col-xl-10 order-1 order-xl-0">
                            <form class="g-3 border p-4 rounded-2" action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="type" class="col-sm-4 control-label">Type catégorie <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <select class="custom-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                            <option value="">Selectionner un type...</option>
                                            <option value="events">Evènements</option>
                                            <option value="articles">Articles</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="titre" class="col-sm-4 control-label">Titre <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" id="titre" placeholder="Nom catégorie...">
                                        @error('titre')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="description">Description</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" maxlength="300" placeholder="Description de la catégorie...">{{ old('description') }}</textarea>
                                        <small id="charCount" class="text-muted">0 / 300 caractères utilisés</small>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#description').keyup(function() {
            var text_length = $('#description').val().length;
            $('#charCount').text(text_length + ' / 300 caractères utilisés');
        });
    });
</script>
@endsection
