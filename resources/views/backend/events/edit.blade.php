@extends('backend.layouts.layouts')
@section('event', 'active')
@section('title', 'Modifier un évènement')
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
                    <h4 class="card-title">MODIFIER UN EVENEMENT</h4>
                    <hr>
                    <div class="row g-4">
                        <div class="col-12 col-xl-10 order-1 order-xl-0">
                            <form action="{{ route('evenements.update', $event->id) }}" method="POST" class="g-3 border p-4 rounded-2" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="titre">Titre <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" placeholder="Titre de l'évènement..." value="{{ old('titre') ? old('titre') : $event->libelle }}" required>
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
                                                <option value="{{ $categorie->id }}" {{ $event->id_categorie == old('categorie') ? 'selected' : ($event->id_categorie == $categorie->id ? 'selected' : '') }}>{{ $categorie->nom_categorie }}</option>
                                            @endforeach
                                        </select>
                                        @error('categorie')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="structure">Structure <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <select class="custom-select @error('structure') is-invalid @enderror select2" id="structure" name="structure" required>
                                            <option value="">Choisir une structure...</option>
                                            @foreach($structures as $structure)
                                                <option value="{{ $structure->id }}" {{ $event->id_structure == old('structure') ? 'selected' : ($event->id_structure == $structure->id ? 'selected' : '') }}>{{ mb_strtoupper($structure->niveau_structure->libelle).' - '.$structure->nom_structure }}</option>
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
                                        <input type="date" class="form-control @error('date_event') is-invalid @enderror" id="date_event" name="date_event" value="{{ old('date_event') ? old('date_event') : $event->date_event}}" required>
                                        @error('date_event')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="description">Description <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Description de l'évènement..." required>{{ old('description') ? old('description') : $event->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Image</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage(event)">
                                        <img id="imagePreview" src="{{ $event->url_img ? asset('images/events/'.$event->url_img) : asset('images/events/default_event.png') }}" class="mt-2 mb-2" style="max-width: 380px; border: 1px solid #ddd; padding: 5px;">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                                    <a href="{{ route('evenements.index') }}" class="btn btn-secondary">Annuler</a>
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
@section('script')
<script>
    function previewImage(event) {
        const input = event.target;
        const file = input.files[0];
        if (file.size > 5 * 1024 * 1024) {
            swal({
                title: 'Attention !',
                text: 'L\'image ne doit pas dépasser 5 Mo.',
                icon: 'warning',
                button: 'Fermer'
            });

            input.value = '';
            return;
        }

        const img = new Image();
        img.src = URL.createObjectURL(file);
        img.onload = function() {
            if (img.width < 1920 || img.height < 1080) {
                swal({
                    title: 'Attention !',
                    text: 'Les dimensions de l\'image doivent être de 1920x1080 pixels au minimum.',
                    icon: 'warning',
                    button: 'Fermer'
                });

                input.value = '';
                return;
            }

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
    }
</script>
@endsection


